param(
    [string]$LaravelSession,
    [string]$XsrfToken
)

Add-Type -AssemblyName System.Net.Http

function New-Ws {
    param($url)
    $ws = New-Object System.Net.WebSockets.ClientWebSocket
    $cts = New-Object System.Threading.CancellationTokenSource
    $task = $ws.ConnectAsync([Uri]$url, $cts.Token)
    $task.Wait()
    return $ws
}

function Send-Cdp {
    param($ws, $id, $method, $paramsObj)
    $msg = @{ id = $id; method = $method; params = $paramsObj } | ConvertTo-Json -Depth 10 -Compress
    $bytes = [System.Text.Encoding]::UTF8.GetBytes($msg)
    $buffer = New-Object System.ArraySegment[byte] (,$bytes)
    $ws.SendAsync($buffer, [System.Net.WebSockets.WebSocketMessageType]::Text, $true, [System.Threading.CancellationToken]::None).Wait()
}

function Receive-CdpAll {
    param($ws, $timeoutMs = 4000)
    $results = @()
    $sw = [Diagnostics.Stopwatch]::StartNew()
    while ($sw.ElapsedMilliseconds -lt $timeoutMs) {
        $buffer = New-Object byte[] 65536
        $seg = New-Object System.ArraySegment[byte] (,$buffer)
        $task = $ws.ReceiveAsync($seg, [System.Threading.CancellationToken]::None)
        if (-not $task.AsyncWaitHandle.WaitOne(300)) { continue }
        $result = $task.Result
        $text = [System.Text.Encoding]::UTF8.GetString($buffer, 0, $result.Count)
        $results += $text
    }
    return $results
}

# 1. Get browser-level target list, find/create a page target
$targets = Invoke-RestMethod -Uri "http://127.0.0.1:9222/json"
$pageTarget = $targets | Where-Object { $_.type -eq 'page' } | Select-Object -First 1
if (-not $pageTarget) {
    $pageTarget = Invoke-RestMethod -Uri "http://127.0.0.1:9222/json/new?about:blank" -Method PUT
}
$wsUrl = $pageTarget.webSocketDebuggerUrl
"Connecting to: $wsUrl"

$ws = New-Ws $wsUrl

# enable domains
Send-Cdp $ws 1 "Page.enable" @{}
Send-Cdp $ws 2 "Network.enable" @{}
Send-Cdp $ws 3 "Runtime.enable" @{}
Send-Cdp $ws 4 "Log.enable" @{}
Receive-CdpAll $ws 1000 | Out-Null

# set cookies
Send-Cdp $ws 5 "Network.setCookie" @{ name = "laravel_session"; value = $LaravelSession; domain = "127.0.0.1"; path = "/" }
Send-Cdp $ws 6 "Network.setCookie" @{ name = "XSRF-TOKEN"; value = $XsrfToken; domain = "127.0.0.1"; path = "/" }
Receive-CdpAll $ws 1000 | Out-Null

# navigate
Send-Cdp $ws 7 "Page.navigate" @{ url = "http://127.0.0.1:8123/admin/landing-sections" }
Start-Sleep -Seconds 2
$navMsgs = Receive-CdpAll $ws 2500

# collect console errors via Runtime.evaluate of a marker + check window for errors using try/catch capture pattern:
Send-Cdp $ws 8 "Runtime.evaluate" @{ expression = "document.title" }
$titleMsgs = Receive-CdpAll $ws 1500
"TITLE RESPONSE:"
$titleMsgs | Where-Object { $_ -match '"id":8' }

# Inject a console error collector retroactively won't catch past errors; instead check global error count via window.__errCount if we'd set listener before load.
# Re-navigate with a preload script that records errors, using Page.addScriptToEvaluateOnNewDocument
Send-Cdp $ws 9 "Page.addScriptToEvaluateOnNewDocument" @{ source = "window.__errors = []; window.addEventListener('error', e => window.__errors.push(e.message));" }
Receive-CdpAll $ws 800 | Out-Null
Send-Cdp $ws 10 "Page.navigate" @{ url = "http://127.0.0.1:8123/admin/landing-sections" }
Start-Sleep -Seconds 2
Receive-CdpAll $ws 2000 | Out-Null

Send-Cdp $ws 11 "Runtime.evaluate" @{ expression = "JSON.stringify({title: document.title, tabs: document.querySelectorAll('.type-tab').length, previewLen: document.getElementById('sectionPreview').innerHTML.length, errors: window.__errors})" }
$evalMsgs = Receive-CdpAll $ws 1500
"EVAL RESPONSE:"
$evalMsgs | Where-Object { $_ -match '"id":11' }

# Click the "Features" tab (2nd tab) and re-check preview + repeater add
Send-Cdp $ws 12 "Runtime.evaluate" @{ expression = "document.querySelectorAll('.type-tab')[1].click(); 'clicked-features'" }
Receive-CdpAll $ws 800 | Out-Null
Send-Cdp $ws 13 "Runtime.evaluate" @{ expression = "JSON.stringify({activeType: window.activeType, featureItems: document.querySelectorAll('#featureList .repeater-item').length, previewHtmlSnippet: document.getElementById('sectionPreview').innerHTML.substring(0,300), errors: window.__errors})" }
$featMsgs = Receive-CdpAll $ws 1200
"FEATURES TAB RESPONSE:"
$featMsgs | Where-Object { $_ -match '"id":13' }

# add a feature item
Send-Cdp $ws 14 "Runtime.evaluate" @{ expression = "addFeature(); document.querySelectorAll('#featureList .repeater-item').length" }
Receive-CdpAll $ws 800 | Out-Null
Send-Cdp $ws 15 "Runtime.evaluate" @{ expression = "JSON.stringify({afterAddCount: document.querySelectorAll('#featureList .repeater-item').length, errors: window.__errors})" }
$addMsgs = Receive-CdpAll $ws 1200
"AFTER ADD FEATURE:"
$addMsgs | Where-Object { $_ -match '"id":15' }

# remove the last feature item
Send-Cdp $ws 16 "Runtime.evaluate" @{ expression = "var items = document.querySelectorAll('#featureList .repeater-item'); items[items.length-1].querySelector('button').click(); 'removed'" }
Receive-CdpAll $ws 800 | Out-Null
Send-Cdp $ws 17 "Runtime.evaluate" @{ expression = "JSON.stringify({afterRemoveCount: document.querySelectorAll('#featureList .repeater-item').length, errors: window.__errors})" }
$remMsgs = Receive-CdpAll $ws 1200
"AFTER REMOVE FEATURE:"
$remMsgs | Where-Object { $_ -match '"id":17' }

# cycle through all 7 tabs and capture errors + preview length for each
Send-Cdp $ws 18 "Runtime.evaluate" @{ expression = @"
(function(){
  var out = [];
  var tabs = document.querySelectorAll('.type-tab');
  for (var i=0;i<tabs.length;i++){
    tabs[i].click();
    var p = document.getElementById('sectionPreview');
    out.push({tab: tabs[i].textContent.trim(), previewLen: p.innerHTML.length});
  }
  return JSON.stringify({results: out, errors: window.__errors});
})()
"@ }
Receive-CdpAll $ws 1000 | Out-Null
Send-Cdp $ws 19 "Runtime.evaluate" @{ expression = "1" }
$allTabsMsgs = Receive-CdpAll $ws 2000
"ALL TABS RESPONSE (id 18):"
$allTabsMsgs | Where-Object { $_ -match '"id":18' }

# screenshot
Send-Cdp $ws 20 "Page.captureScreenshot" @{ format = "png" }
$shotMsgs = Receive-CdpAll $ws 3000
$shotMsg = $shotMsgs | Where-Object { $_ -match '"id":20' } | Select-Object -First 1
if ($shotMsg) {
    $obj = $shotMsg | ConvertFrom-Json
    $bytes = [Convert]::FromBase64String($obj.result.data)
    [IO.File]::WriteAllBytes("C:\laravel projects\webadmin\landing_screenshot.png", $bytes)
    "Screenshot saved."
}

$ws.Dispose()
