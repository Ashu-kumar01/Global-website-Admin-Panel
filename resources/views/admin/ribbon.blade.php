@extends('adminlayout.app')
@section('title', 'Highlight Ribbon')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Highlight Ribbon</h2>
                <p>Configure up to 3 announcement ribbons shown on the site — text, color, font, height, position and behaviour.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="field-error show" style="background:var(--green-50,#f0fdf4);color:var(--green-600,#16a34a);padding:12px 16px;border-radius:8px;margin-bottom:18px;">
                <i class="fas fa-circle-check"></i>&nbsp; {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="field-error show" style="background:#fef2f2;color:var(--red-600);padding:12px 16px;border-radius:8px;margin-bottom:18px;display:block;">
                <i class="fas fa-triangle-exclamation"></i>&nbsp; {{ $errors->first() }}
            </div>
        @endif

        <style>
            @keyframes ribbonSlide {
                0% { transform: translateX(100%); }
                100% { transform: translateX(-100%); }
            }
        </style>

        <form id="ribbonForm" method="POST" action="{{ route('admin.ribbon.save') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payload" id="payloadField">

            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-bars-staggered"></i> Ribbons <span style="font-weight:400;color:var(--grey-500,#6b7280);font-size:.8rem;">(max {{ $initialState['max_ribbons'] }})</span></h3>
                    <button type="button" class="btn-reset" id="addRibbonBtn" onclick="addRibbon()"><i class="fas fa-plus"></i> Add Ribbon</button>
                </div>
            </div>

            <div id="ribbonsContainer"></div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Save
                </button>
                <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            </div>
        </form>
    </div>

    <script>
        const initial = @json($initialState);
        const MAX_RIBBONS = initial.max_ribbons || 3;
        const NOTICE_GAP_PX = 100;

        const FONT_FAMILIES = [
            ['', 'Default (theme font)'],
            ['Arial, sans-serif', 'Arial'],
            ['Helvetica, Arial, sans-serif', 'Helvetica'],
            ["'Times New Roman', serif", 'Times New Roman'],
            ['Georgia, serif', 'Georgia'],
            ['Verdana, sans-serif', 'Verdana'],
            ["'Trebuchet MS', sans-serif", 'Trebuchet MS'],
            ["'Courier New', monospace", 'Courier New'],
            ["'Poppins', sans-serif", 'Poppins'],
            ["'Inter', sans-serif", 'Inter'],
            ["'Roboto', sans-serif", 'Roboto'],
            ['system-ui, sans-serif', 'System UI'],
        ];

        const FONT_WEIGHTS = [
            ['300', 'Light (300)'],
            ['400', 'Normal (400)'],
            ['500', 'Medium (500)'],
            ['600', 'Semibold (600)'],
            ['700', 'Bold (700)'],
            ['800', 'Extrabold (800)'],
        ];

        let ribbonUid = 0;

        function escapeHtml(str) {
            return (str || '').replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
        }

        function fontFamilyOptions(selected) {
            return FONT_FAMILIES.map(([value, label]) =>
                `<option value="${escapeHtml(value)}" ${value === (selected || '') ? 'selected' : ''}>${label}</option>`
            ).join('');
        }

        function fontWeightOptions(selected) {
            return FONT_WEIGHTS.map(([value, label]) =>
                `<option value="${value}" ${value === String(selected || '600') ? 'selected' : ''}>${label}</option>`
            ).join('');
        }

        // ── Notices (scoped per ribbon) ──

        function noticeHtml(rUid, nUid, data) {
            data = data || {};
            return `
                <div class="notice-item" data-nuid="${nUid}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:14px;margin-bottom:14px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong class="notice-label" style="font-size:.86rem;"></strong>
                        <button type="button" class="btn-reset" onclick="removeNotice(${rUid}, ${nUid})"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Notice Text</label>
                        <textarea class="form-field notice-text" rows="2" maxlength="300" placeholder="e.g. Admissions open for 2026-27 — Apply now!" oninput="updatePreview(${rUid})">${escapeHtml(data.name)}</textarea>
                    </div>
                    <div style="display:flex;gap:24px;flex-wrap:wrap;margin-top:10px;">
                        <div class="form-section" style="flex:1;min-width:220px;">
                            <label class="field-label">Link (onclick open URL)</label>
                            <input type="url" class="form-field notice-link" value="${escapeHtml(data.link)}" placeholder="https://example.com/notice" oninput="updatePreview(${rUid})">
                        </div>
                        <div class="form-section" style="flex:1;min-width:220px;">
                            <label class="field-label">Attach File</label>
                            <input type="file" class="form-field notice-file" onchange="updatePreview(${rUid})">
                            <input type="hidden" class="notice-existing-file" value="${escapeHtml(data.existing_file)}">
                            <p class="notice-file-name" style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">${data.existing_file ? 'Current: ' + escapeHtml(data.existing_file.split('/').pop()) : ''}</p>
                        </div>
                    </div>
                </div>
            `;
        }

        function renumberNotices(rUid) {
            document.querySelectorAll(`#noticesContainer-${rUid} .notice-item`).forEach((el, idx) => {
                el.querySelector('.notice-label').textContent = 'Notice #' + (idx + 1);
            });
        }

        function addNotice(rUid, data) {
            const item = document.querySelector(`.ribbon-item[data-ruid="${rUid}"]`);
            const nUid = (parseInt(item.dataset.noticeUid || '0', 10)) + 1;
            item.dataset.noticeUid = nUid;
            document.getElementById('noticesContainer-' + rUid).insertAdjacentHTML('beforeend', noticeHtml(rUid, nUid, data));
            const wrap = document.querySelector(`#noticesContainer-${rUid} .notice-item[data-nuid="${nUid}"]`);
            wrap.querySelector('.notice-file').addEventListener('change', function () {
                wrap.querySelector('.notice-file-name').textContent = this.files.length ? this.files[0].name : '';
            });
            renumberNotices(rUid);
            updatePreview(rUid);
        }

        function removeNotice(rUid, nUid) {
            const el = document.querySelector(`#noticesContainer-${rUid} .notice-item[data-nuid="${nUid}"]`);
            if (el) el.remove();
            renumberNotices(rUid);
            updatePreview(rUid);
        }

        function getNotices(rUid) {
            return Array.from(document.querySelectorAll(`#noticesContainer-${rUid} .notice-item`)).map(item => ({
                text: item.querySelector('.notice-text').value.trim(),
                link: item.querySelector('.notice-link').value.trim(),
            })).filter(n => n.text);
        }

        // ── Ribbon preview ──

        function updatePreview(rUid) {
            const item = document.querySelector(`.ribbon-item[data-ruid="${rUid}"]`);
            if (!item) return;

            const notices = getNotices(rUid);
            const bgColor = item.querySelector('.ribbon-bg-color').value;
            const textColor = item.querySelector('.ribbon-text-color').value;
            const fontFamily = item.querySelector('.ribbon-font-family').value;
            const fontSize = item.querySelector('.ribbon-font-size').value;
            const fontWeight = item.querySelector('.ribbon-font-weight').value;
            const ribbonHeight = item.querySelector('.ribbon-height').value;
            const position = item.querySelector('.ribbon-position').value;
            const cssPosition = item.querySelector('.ribbon-css-position').value;
            const showClose = item.querySelector('input[name^="ribbonCloseBtnRadio"]:checked').value === 'yes';
            const isSlide = item.querySelector('input[name^="ribbonAnimation"]:checked').value === 'yes';
            const slideSpeed = item.querySelector('.ribbon-speed').value;

            item.querySelector('.ribbon-speed-wrap').style.display = isSlide ? '' : 'none';
            item.querySelector('.ribbon-font-size-value').textContent = fontSize;
            item.querySelector('.ribbon-height-value').textContent = ribbonHeight;

            const list = notices.length ? notices : [{ text: 'Your highlight ribbon text will appear here', link: '' }];

            const bar = item.querySelector('.ribbon-bar');
            bar.style.background = bgColor;
            bar.style.color = textColor;
            bar.style.top = position === 'top' ? '0' : 'auto';
            bar.style.bottom = position === 'bottom' ? '0' : 'auto';
            bar.style.position = cssPosition;
            bar.style.minHeight = ribbonHeight + 'px';

            const closeBtn = item.querySelector('.ribbon-close-btn');
            closeBtn.style.display = showClose ? '' : 'none';
            closeBtn.style.color = textColor;

            const newBadge = item.querySelector('.ribbon-new-badge');
            newBadge.style.display = list.length > 1 ? '' : 'none';

            const textEl = item.querySelector('.ribbon-text');
            textEl.innerHTML = '';
            textEl.style.color = textColor;
            textEl.style.fontFamily = fontFamily || 'inherit';
            textEl.style.fontSize = fontSize + 'px';
            textEl.style.fontWeight = fontWeight;

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
                textEl.style.whiteSpace = 'nowrap';
            } else {
                textEl.style.animation = 'none';
                textEl.style.whiteSpace = 'normal';
            }
        }

        // ── Ribbons ──

        function ribbonHtml(rUid, data) {
            data = data || {};
            const bg = data.backgroundColor || '#2563eb';
            const text = data.textColor || '#ffffff';
            const fontSize = data.fontSize || 14;
            const fontWeight = data.fontWeight || '600';
            const ribbonHeight = data.ribbonHeight || 44;
            const position = data.ribbonPosition || 'top';
            const cssPosition = data.position || 'fixed';
            const closeYes = (data.ribbonCloseBtnRadio || 'yes') === 'yes';
            const animYes = (data.ribbonAnimation || 'no') === 'yes';
            const speed = data.sliderSpeed || 10;

            return `
                <div class="ribbon-item panel" data-ruid="${rUid}" data-notice-uid="0" style="margin-bottom:24px;overflow:visible;">
                    <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                        <h3 class="panel-head-title ribbon-label"><i class="fas fa-bullhorn"></i></h3>
                        <button type="button" class="btn-reset" onclick="removeRibbon(${rUid})"><i class="fas fa-trash"></i> Remove Ribbon</button>
                    </div>
                    <div class="panel-body">

                        <div style="position:relative;height:160px;border:1px dashed var(--grey-200);border-radius:8px;overflow:hidden;background:repeating-linear-gradient(45deg,#fafafa,#fafafa 10px,#f3f4f6 10px,#f3f4f6 20px);margin-bottom:20px;">
                            <div class="ribbon-bar" style="position:absolute;left:0;width:100%;padding:10px 16px;display:flex;align-items:center;gap:12px;overflow:hidden;">
                                <span class="ribbon-new-badge" style="flex-shrink:0;background:#ef4444;color:#fff;font-size:.65rem;font-weight:700;padding:2px 6px;border-radius:4px;letter-spacing:.04em;display:none;">NEW</span>
                                <div style="flex:1;overflow:hidden;white-space:nowrap;">
                                    <span class="ribbon-text" style="width:100%;display:inline-block;"></span>
                                </div>
                                <button type="button" class="ribbon-close-btn" style="background:transparent;border:none;cursor:pointer;font-size:1rem;line-height:1;flex-shrink:0;">
                                    <i class="fas fa-xmark"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Notices -->
                        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                            <strong style="font-size:.86rem;"><i class="fas fa-align-left"></i> Notices</strong>
                            <button type="button" class="btn-reset" onclick="addNotice(${rUid})"><i class="fas fa-plus"></i> Add Notice</button>
                        </div>
                        <div id="noticesContainer-${rUid}" style="margin-bottom:20px;"></div>

                        <!-- Colors -->
                        <div style="display:flex;gap:24px;flex-wrap:wrap;margin-bottom:20px;">
                            <div class="form-section">
                                <label class="field-label">Background Color</label>
                                <input type="color" class="form-field ribbon-bg-color" value="${bg}" style="width:80px;height:40px;padding:4px;" oninput="updatePreview(${rUid})">
                            </div>
                            <div class="form-section">
                                <label class="field-label">Text Color</label>
                                <input type="color" class="form-field ribbon-text-color" value="${text}" style="width:80px;height:40px;padding:4px;" oninput="updatePreview(${rUid})">
                            </div>
                        </div>

                        <!-- Typography & Height -->
                        <div style="display:flex;gap:24px;flex-wrap:wrap;margin-bottom:20px;">
                            <div class="form-section" style="flex:1;min-width:200px;">
                                <label class="field-label">Font Family</label>
                                <select class="form-field ribbon-font-family" onchange="updatePreview(${rUid})">
                                    ${fontFamilyOptions(data.fontFamily)}
                                </select>
                            </div>
                            <div class="form-section" style="flex:1;min-width:160px;">
                                <label class="field-label">Font Weight</label>
                                <select class="form-field ribbon-font-weight" onchange="updatePreview(${rUid})">
                                    ${fontWeightOptions(fontWeight)}
                                </select>
                            </div>
                        </div>
                        <div style="display:flex;gap:24px;flex-wrap:wrap;margin-bottom:20px;">
                            <div class="form-section" style="flex:1;min-width:200px;max-width:280px;">
                                <label class="field-label">Font Size: <span class="ribbon-font-size-value">${fontSize}</span>px</label>
                                <input type="range" class="form-field ribbon-font-size" min="10" max="32" value="${fontSize}" oninput="updatePreview(${rUid})">
                            </div>
                            <div class="form-section" style="flex:1;min-width:200px;max-width:280px;">
                                <label class="field-label">Ribbon Height: <span class="ribbon-height-value">${ribbonHeight}</span>px</label>
                                <input type="range" class="form-field ribbon-height" min="28" max="120" value="${ribbonHeight}" oninput="updatePreview(${rUid})">
                            </div>
                        </div>

                        <!-- Position -->
                        <div style="display:flex;gap:24px;flex-wrap:wrap;margin-bottom:20px;">
                            <div class="form-section">
                                <label class="field-label">Show Ribbon At</label>
                                <select class="form-field ribbon-position" style="max-width:200px;" onchange="updatePreview(${rUid})">
                                    <option value="top" ${position === 'top' ? 'selected' : ''}>Top</option>
                                    <option value="bottom" ${position === 'bottom' ? 'selected' : ''}>Bottom</option>
                                </select>
                            </div>
                            <div class="form-section">
                                <label class="field-label">CSS Position</label>
                                <select class="form-field ribbon-css-position" style="max-width:200px;" onchange="updatePreview(${rUid})">
                                    <option value="fixed" ${cssPosition === 'fixed' ? 'selected' : ''}>Fixed</option>
                                    <option value="absolute" ${cssPosition === 'absolute' ? 'selected' : ''}>Absolute</option>
                                </select>
                            </div>
                        </div>

                        <!-- Close button -->
                        <div class="form-section" style="margin-bottom:20px;">
                            <label class="field-label">Close Button</label>
                            <div style="display:flex;gap:18px;">
                                <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                    <input type="radio" name="ribbonCloseBtnRadio-${rUid}" value="yes" ${closeYes ? 'checked' : ''} onchange="updatePreview(${rUid})"> Show
                                </label>
                                <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                    <input type="radio" name="ribbonCloseBtnRadio-${rUid}" value="no" ${!closeYes ? 'checked' : ''} onchange="updatePreview(${rUid})"> Hide
                                </label>
                            </div>
                        </div>

                        <!-- Animation -->
                        <div class="form-section">
                            <label class="field-label">Text Animation</label>
                            <div style="display:flex;gap:18px;margin-bottom:12px;">
                                <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                    <input type="radio" name="ribbonAnimation-${rUid}" value="yes" ${animYes ? 'checked' : ''} onchange="updatePreview(${rUid})"> Slide Text
                                </label>
                                <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                    <input type="radio" name="ribbonAnimation-${rUid}" value="no" ${!animYes ? 'checked' : ''} onchange="updatePreview(${rUid})"> Static Text
                                </label>
                            </div>
                            <div class="ribbon-speed-wrap" style="display:${animYes ? '' : 'none'};max-width:280px;">
                                <label class="field-label">Slide Speed: <span class="ribbon-speed-value">${speed}</span>s</label>
                                <input type="range" class="form-field ribbon-speed" min="2" max="60" value="${speed}" oninput="this.closest('.ribbon-item').querySelector('.ribbon-speed-value').textContent=this.value; updatePreview(${rUid})">
                                <p style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">Lower value = faster scroll.</p>
                            </div>
                        </div>

                    </div>
                </div>
            `;
        }

        function renumberRibbons() {
            const items = document.querySelectorAll('.ribbon-item');
            items.forEach((el, idx) => {
                el.querySelector('.ribbon-label').innerHTML = `<i class="fas fa-bullhorn"></i> Ribbon #${idx + 1}`;
            });
            document.getElementById('addRibbonBtn').style.display = items.length >= MAX_RIBBONS ? 'none' : '';
        }

        function addRibbon(data) {
            if (document.querySelectorAll('.ribbon-item').length >= MAX_RIBBONS) return;

            ribbonUid++;
            const uid = ribbonUid;
            document.getElementById('ribbonsContainer').insertAdjacentHTML('beforeend', ribbonHtml(uid, data));

            const notices = (data && data.notices) || [];
            if (notices.length) {
                notices.forEach(n => addNotice(uid, n));
            } else {
                addNotice(uid);
            }

            renumberRibbons();
            updatePreview(uid);
        }

        function removeRibbon(uid) {
            const el = document.querySelector(`.ribbon-item[data-ruid="${uid}"]`);
            if (el) el.remove();
            renumberRibbons();
        }

        document.getElementById('ribbonForm').addEventListener('submit', function () {
            const payload = { ribbons: [] };

            document.querySelectorAll('#ribbonsContainer .ribbon-item').forEach((ribbonEl, rIdx) => {
                const noticesPayload = [];

                ribbonEl.querySelectorAll(':scope [id^="noticesContainer-"] .notice-item').forEach((noticeEl, nIdx) => {
                    noticesPayload.push({
                        name: noticeEl.querySelector('.notice-text').value.trim(),
                        link: noticeEl.querySelector('.notice-link').value.trim(),
                        existing_file: noticeEl.querySelector('.notice-existing-file').value || null,
                    });

                    const fileInput = noticeEl.querySelector('.notice-file');
                    fileInput.name = `ribbons[${rIdx}][notices][${nIdx}][file]`;
                });

                payload.ribbons.push({
                    backgroundColor: ribbonEl.querySelector('.ribbon-bg-color').value,
                    textColor: ribbonEl.querySelector('.ribbon-text-color').value,
                    fontFamily: ribbonEl.querySelector('.ribbon-font-family').value,
                    fontSize: parseInt(ribbonEl.querySelector('.ribbon-font-size').value, 10),
                    fontWeight: ribbonEl.querySelector('.ribbon-font-weight').value,
                    ribbonHeight: parseInt(ribbonEl.querySelector('.ribbon-height').value, 10),
                    ribbonPosition: ribbonEl.querySelector('.ribbon-position').value,
                    position: ribbonEl.querySelector('.ribbon-css-position').value,
                    ribbonCloseBtnRadio: ribbonEl.querySelector('input[name^="ribbonCloseBtnRadio"]:checked').value,
                    ribbonAnimation: ribbonEl.querySelector('input[name^="ribbonAnimation"]:checked').value,
                    sliderSpeed: parseInt(ribbonEl.querySelector('.ribbon-speed').value, 10),
                    notices: noticesPayload,
                });
            });

            document.getElementById('payloadField').value = JSON.stringify(payload);
        });

        // Initial state
        (function () {
            if ((initial.ribbons || []).length) {
                initial.ribbons.forEach(addRibbon);
            } else {
                addRibbon();
            }
        })();
    </script>

@endsection
