@extends('adminlayout.app')
@section('title', 'Highlight Ribbon')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Highlight Ribbon</h2>
                <p>Configure the announcement ribbon shown on the site — text, color, position and behaviour.</p>
            </div>
        </div>

        <div class="panel" id="previewPanel" style="margin-bottom:24px;overflow:visible;">
            <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                <h3 class="panel-head-title"><i class="fas fa-eye"></i> Ribbon Preview</h3>
            </div>
            <div class="panel-body" style="padding:0;">
                <div id="ribbonPreviewStage"
                    style="position:relative;height:220px;border:1px dashed var(--grey-200);border-radius:0 0 8px 8px;overflow:hidden;background:repeating-linear-gradient(45deg,#fafafa,#fafafa 10px,#f3f4f6 10px,#f3f4f6 20px);">
                    <div id="ribbonBar"
                        style="position:absolute;left:0;width:100%;padding:10px 16px;display:flex;align-items:center;gap:12px;overflow:hidden;">
                        <span id="ribbonNewBadge"
                            style="flex-shrink:0;background:#ef4444;color:#fff;font-size:.65rem;font-weight:700;padding:2px 6px;border-radius:4px;letter-spacing:.04em;display:none;">NEW</span>
                        <div id="ribbonTextWrap" style="flex:1;overflow:hidden;white-space:nowrap;">
                            <span id="ribbonText"
                                style="width:100%;display:inline-block;font-size:.86rem;font-weight:600;"></span>
                        </div>
                        <button type="button" id="ribbonCloseBtn"
                            style="background:transparent;border:none;cursor:pointer;font-size:1rem;line-height:1;flex-shrink:0;">
                            <i class="fas fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <style>
            @keyframes ribbonSlide {
                0% {
                    transform: translateX(100%);
                }

                100% {
                    transform: translateX(-100%);
                }
            }
        </style>

        <form id="ribbonForm" method="POST" action="{{ route('admin.ribbon.save') }}" enctype="multipart/form-data">
            @csrf
 
            <!-- Ribbon Notices -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-align-left"></i> Ribbon Notices</h3>
                    <button type="button" class="btn-reset" onclick="addNotice()">
                        <i class="fas fa-plus"></i> Add Notice
                    </button>
                </div>
                <div class="panel-body">
                    <div id="noticeList"></div>
                </div>
            </div>

            <!-- Colors -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-palette"></i> Ribbon Color</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:24px;flex-wrap:wrap;">
                        <div class="form-section">
                            <label class="field-label">Background Color</label>
                            <input type="color" id="ribbonBgColor" name="backgroundColor" class="form-field"
                                value="{{ $ribbon->backgroundColor ?? '#2563eb' }}" style="width:80px;height:40px;padding:4px;" oninput="updatePreview()">
                        </div>
                        <div class="form-section">
                            <label class="field-label">Text Color</label>
                            <input type="color" id="ribbonTextColor" name="textColor" class="form-field" value="{{ $ribbon->textColor ?? '#ffffff' }}"
                                style="width:80px;height:40px;padding:4px;" oninput="updatePreview()">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Position -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-arrows-up-down"></i> Position</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:24px;flex-wrap:wrap;">
                        <div class="form-section">
                            <label class="field-label">Show Ribbon At</label>
                            <select id="ribbonPosition" class="form-field" name="ribbonPosition" style="max-width:200px;"
                                onchange="updatePreview()">
                                <option value="top" {{ ($ribbon->ribbonPosition ?? 'top') === 'top' ? 'selected' : '' }}>Top</option>
                                <option value="bottom" {{ ($ribbon->ribbonPosition ?? '') === 'bottom' ? 'selected' : '' }}>Bottom</option>
                            </select>
                        </div>
                        <div class="form-section">
                            <label class="field-label">CSS Position</label>
                            <select id="ribbonCssPosition" class="form-field" name="position" style="max-width:200px;"
                                onchange="updatePreview()">
                                <option value="fixed" {{ ($ribbon->position ?? 'fixed') === 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="absolute" {{ ($ribbon->position ?? '') === 'absolute' ? 'selected' : '' }}>Absolute</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Close button -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-xmark"></i> Close Button</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:18px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="ribbonCloseBtnRadio" value="yes" id="ribbonCloseYes" {{ ($ribbon->ribbonCloseBtnRadio ?? true) ? 'checked' : '' }}
                                onchange="updatePreview()"> Show
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="ribbonCloseBtnRadio" value="no" id="ribbonCloseNo" {{ isset($ribbon) && !$ribbon->ribbonCloseBtnRadio ? 'checked' : '' }}
                                onchange="updatePreview()"> Hide
                        </label>
                    </div>
                </div>
            </div>

            <!-- Slide -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-arrows-left-right"></i> Text Animation</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:18px;margin-bottom:16px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="ribbonAnimation" value="yes" id="ribbonSlideYes" {{ ($ribbon->ribbonAnimation ?? 'no') === 'yes' ? 'checked' : '' }}
                                onchange="updatePreview()"> Slide Text
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="ribbonAnimation" value="no" id="ribbonSlideNo" {{ ($ribbon->ribbonAnimation ?? 'no') === 'no' ? 'checked' : '' }}
                                onchange="updatePreview()"> Static Text
                        </label>
                    </div>
                    <div class="form-section" id="ribbonSpeedWrap" style="display:{{ ($ribbon->ribbonAnimation ?? 'no') === 'yes' ? '' : 'none' }};max-width:280px;">
                        <label class="field-label">Slide Speed: <span id="ribbonSpeedValue">{{ $ribbon->sliderSpeed ?? 10 }}</span>s</label>
                        <input type="range" id="ribbonSpeed" name="sliderSpeed" min="2" max="60"
                            value="{{ $ribbon->sliderSpeed ?? 10 }}" class="form-field"
                            oninput="document.getElementById('ribbonSpeedValue').textContent = this.value; updatePreview()">
                        <p style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">Lower value = faster
                            scroll.</p>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn-reset" onclick="updatePreview()">
                    <i class="fas fa-eye"></i> Refresh Preview
                </button>
                <button type="reset" class="btn-reset"
                    onclick="document.getElementById('ribbonForm').reset(); document.getElementById('ribbonSpeedWrap').style.display='none'; resetNotices(); updatePreview();">Reset</button>
            </div>

        </form>
    </div>

    <script>
        let noticeCount = 0;

        function addNotice(prefill) {
            noticeCount++;
            const id = noticeCount;
            const wrap = document.createElement('div');
            wrap.className = 'notice-item';
            wrap.id = 'notice-' + id;
            wrap.style =
                'display:block;border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:14px;margin-bottom:14px;';
            wrap.innerHTML = `
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                    <strong style="font-size:.86rem;">Notice #${id}</strong>
                    <button type="button" class="btn-reset" onclick="removeNotice(${id})">
                        <i class="fas fa-trash"></i> Remove
                    </button>
                </div>
                <div class="form-section">
                    <label class="field-label">Notice Text</label>
                    <textarea class="form-field notice-text" rows="2" name="notices[${id}][name]" maxlength="300"
                        placeholder="e.g. Admissions open for 2026-27 — Apply now!"
                        oninput="updatePreview()"></textarea>
                </div>
                <div style="display:flex;gap:24px;flex-wrap:wrap;margin-top:10px;">
                    <div class="form-section" style="flex:1;min-width:220px;">
                        <label class="field-label">Link (onclick open URL)</label>
                        <input type="url" name="notices[${id}][link]" class="form-field notice-link" placeholder="https://example.com/notice" oninput="updatePreview()">
                    </div>
                    <div class="form-section" style="flex:1;min-width:220px;">
                        <label class="field-label">Attach File</label>
                        <input type="file" class="form-field notice-file" name="notices[${id}][file]" onchange="updatePreview()">
                        <p class="notice-file-name" style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;"></p>
                    </div>
                </div>
            `;
            document.getElementById('noticeList').appendChild(wrap);

            if (prefill) {
                wrap.querySelector('.notice-text').value = prefill.text || '';
                wrap.querySelector('.notice-link').value = prefill.link || '';
            }

            wrap.querySelector('.notice-file').addEventListener('change', function() {
                const nameEl = wrap.querySelector('.notice-file-name');
                nameEl.textContent = this.files.length ? this.files[0].name : '';
            });

            updatePreview();
        }

        function removeNotice(id) {
            const el = document.getElementById('notice-' + id);
            if (el) el.remove();
            updatePreview();
        }

        function resetNotices() {
            document.getElementById('noticeList').innerHTML = '';
            noticeCount = 0;
            addNotice();
        }

        function getNotices() {
            return Array.from(document.querySelectorAll('.notice-item')).map(item => {
                const fileInput = item.querySelector('.notice-file');
                return {
                    text: item.querySelector('.notice-text').value.trim(),
                    link: item.querySelector('.notice-link').value.trim(),
                    file: fileInput.files.length ? fileInput.files[0].name : null
                };
            }).filter(n => n.text);
        }


        const NOTICE_GAP_PX = 100; // horizontal distance between consecutive notices in the ribbon

        function updatePreview() {
            const notices = getNotices();
            const bgColor = document.getElementById('ribbonBgColor').value;
            const textColor = document.getElementById('ribbonTextColor').value;
            const position = document.getElementById('ribbonPosition').value;
            const cssPosition = document.getElementById('ribbonCssPosition').value;
            const showClose = document.querySelector('input[name="ribbonCloseBtnRadio"]:checked').value === 'yes';
            const isSlide = document.querySelector('input[name="ribbonAnimation"]:checked').value === 'yes';
            const slideSpeed = document.getElementById('ribbonSpeed').value;

            document.getElementById('ribbonSpeedWrap').style.display = isSlide ? '' : 'none';

            const list = notices.length ? notices : [{
                text: 'Your highlight ribbon text will appear here',
                link: ''
            }];

            const bar = document.getElementById('ribbonBar');
            bar.style.background = bgColor;
            bar.style.color = textColor;
            bar.style.top = position === 'top' ? '0' : 'auto';
            bar.style.bottom = position === 'bottom' ? '0' : 'auto';
            bar.style.position = cssPosition;

            document.getElementById('ribbonNewBadge').style.display = list.length > 1 ? '' : 'none';
            document.getElementById('ribbonCloseBtn').style.display = showClose ? '' : 'none';
            document.getElementById('ribbonCloseBtn').style.color = textColor;

            const textEl = document.getElementById('ribbonText');
            textEl.innerHTML = '';
            textEl.style.color = textColor;

            list.forEach((notice, index) => {
                const span = document.createElement('span');
                span.textContent = notice.text;
                span.style.display = 'inline-block';
                if (index < list.length - 1) span.style.marginRight = NOTICE_GAP_PX + 'px';

                if (notice.link) {
                    span.style.cursor = 'pointer';
                    span.style.textDecoration = 'underline';
                    span.onclick = () => window.open(notice.link, '_blank');
                }

                textEl.appendChild(span);
            });

            if (isSlide) {
                textEl.style.animation = 'none';
                requestAnimationFrame(() => {
                    textEl.style.animation = `ribbonSlide ${slideSpeed}s linear infinite`;
                });
                textEl.style.paddingLeft = '0';
                textEl.style.whiteSpace = 'nowrap';
            } else {
                textEl.style.animation = 'none';
                textEl.style.transform = 'none';
                textEl.style.whiteSpace = 'normal';
            }
        }

        const existingNotices = @json(optional($ribbon)->notices ? $ribbon->notices->map(fn($n) => ['text' => $n->name, 'link' => $n->link]) : []);
        if (existingNotices.length) {
            existingNotices.forEach(addNotice);
        } else {
            addNotice();
        }
    </script>

@endsection
