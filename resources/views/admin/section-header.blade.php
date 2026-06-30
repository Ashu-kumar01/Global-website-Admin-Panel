@extends('adminlayout.app')
@section('title', 'Why Choose Us')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Why Choose Us</h2>
                <p>Pick a layout, then fill in its content. Changes apply to the "Why Choose Us" section on the home page.</p>
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

        <form id="whyChooseUsForm" method="POST" action="{{ route('admin.WhyChooseUs.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payload" id="payloadField">
            <input type="hidden" name="layout_type" id="layoutTypeField" value="{{ $initialState['layout_type'] }}">

            <!-- Layout picker -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-table-cells-large"></i> Layout</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div class="layout-option" data-layout="split" onclick="selectLayout('split')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:10px;cursor:pointer;">
                            <img src="{{ asset('images/why_choose_us/why-choose-us_front.png') }}" style="width:100%;border-radius:6px;display:block;margin-bottom:8px;">
                            <strong style="display:block;font-size:.86rem;text-align:center;">Featured Image + Text</strong>
                        </div>
                        <div class="layout-option" data-layout="card" onclick="selectLayout('card')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:10px;cursor:pointer;">
                            <img src="{{ asset('images/why_choose_us/why-choose-us_2_front.png') }}" style="width:100%;border-radius:6px;display:block;margin-bottom:8px;">
                            <strong style="display:block;font-size:.86rem;text-align:center;">Gradient Header + 4 Cards</strong>
                        </div>
                        <div class="layout-option" data-layout="grid" onclick="selectLayout('grid')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:10px;cursor:pointer;">
                            <img src="{{ asset('images/why_choose_us/why-choose-us_3_front.png') }}" style="width:100%;border-radius:6px;display:block;margin-bottom:8px;">
                            <strong style="display:block;font-size:.86rem;text-align:center;">Simple Icon Boxes</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shared header fields -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-heading"></i> Section Header</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Badge</label>
                        <input type="text" class="form-field" id="badgeField" placeholder="e.g. Why SRU" value="{{ $initialState['badge'] }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field" id="headingField" placeholder="e.g. The SRU Advantage" value="{{ $initialState['heading'] }}">
                    </div>

                    <div id="accentFieldsGroup" style="display:none;">
                        <div class="form-section" style="display:flex;gap:16px;">
                            <div style="flex:1;">
                                <label class="field-label">Accent word in heading (colored differently)</label>
                                <input type="text" class="form-field" id="headingAccentTextField" placeholder="e.g. Advantage" value="{{ $initialState['heading_accent_text'] }}">
                            </div>
                            <div>
                                <label class="field-label">Accent Color</label>
                                <input type="color" class="form-field" id="headingAccentColorField" value="{{ $initialState['heading_accent_color'] }}" style="width:80px;height:40px;padding:4px;">
                            </div>
                        </div>
                    </div>

                    <div id="headingColorGroup" style="display:none;">
                        <div class="form-section">
                            <label class="field-label">Heading Color</label>
                            <input type="color" class="form-field" id="headingColorField" value="{{ $initialState['heading_color'] ?: '#0f172a' }}" style="width:80px;height:40px;padding:4px;">
                        </div>
                    </div>

                    <div class="form-section">
                        <label class="field-label" id="subheadingLabel">Subheading</label>
                        <textarea class="form-field" id="subheadingField" rows="4" placeholder="Write a paragraph. Leave a blank line to start a new paragraph. Start a line with - to make a bullet point.">{{ $initialState['subheading'] }}</textarea>
                        <p id="subheadingHint" style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">Blank line = new paragraph. Line starting with "- " = bullet point.</p>
                    </div>

                    <div id="subheadingColorGroup" style="display:none;">
                        <div class="form-section">
                            <label class="field-label">Subheading Color</label>
                            <input type="color" class="form-field" id="subheadingColorField" value="{{ $initialState['subheading_color'] ?: '#6b7280' }}" style="width:80px;height:40px;padding:4px;">
                        </div>
                    </div>

                    <div id="ctaFieldsGroup" style="display:none;">
                        <div class="form-section" style="display:flex;gap:16px;flex-wrap:wrap;">
                            <div style="flex:1;min-width:200px;">
                                <label class="field-label">Button Text</label>
                                <input type="text" class="form-field" id="ctaTextField" placeholder="e.g. Apply Now" value="{{ $initialState['cta_text'] }}">
                            </div>
                            <div style="flex:1;min-width:200px;">
                                <label class="field-label">Button Link</label>
                                <select class="form-field" id="ctaLinkSelect" onchange="toggleCustomLink()">
                                    <option value="">— Select a page —</option>
                                    @foreach ($pages as $page)
                                        <option value="{{ $page['value'] }}">{{ $page['label'] }}</option>
                                    @endforeach
                                    <option value="__custom__">Custom URL…</option>
                                </select>
                                <input type="text" class="form-field" id="ctaLinkCustom" placeholder="https://example.com" style="display:none;margin-top:8px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section background (card layout) -->
            <div class="panel" id="backgroundPanel" style="margin-bottom:24px;display:none;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-fill-drip"></i> Section Background</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:18px;margin-bottom:12px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="sectionBgType" value="color" onchange="toggleSectionBgFields(this.value)"> Color
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="sectionBgType" value="image" onchange="toggleSectionBgFields(this.value)"> Image
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="sectionBgType" value="gradient" onchange="toggleSectionBgFields(this.value)"> Gradient
                        </label>
                    </div>

                    <div id="sectionBgColorWrap" style="display:none;max-width:200px;">
                        <label class="field-label">Background Color</label>
                        <input type="color" class="form-field" id="sectionBgColor" style="width:80px;height:40px;padding:4px;">
                    </div>

                    <div id="sectionBgImageWrap" style="display:none;">
                        <label class="field-label">Background Image</label>
                        <input type="file" class="form-field" id="sectionBgImageInput" accept="image/*" onchange="previewImage(this, 'sectionBgImagePreview')">
                        <img id="sectionBgImagePreview" src="{{ $initialState['design']['background_image'] }}" style="display:{{ $initialState['design']['background_image'] ? '' : 'none' }};margin-top:8px;max-height:80px;border-radius:6px;border:1px solid var(--grey-200);">
                    </div>

                    <div id="sectionBgGradientWrap" style="display:none;max-width:320px;">
                        <div style="display:flex;gap:12px;margin-bottom:10px;">
                            <div>
                                <label class="field-label">Color 1</label>
                                <input type="color" class="form-field" id="sectionGradientColor1" value="{{ $initialState['design']['gradient_color_1'] }}" style="width:80px;height:40px;padding:4px;">
                            </div>
                            <div>
                                <label class="field-label">Color 2</label>
                                <input type="color" class="form-field" id="sectionGradientColor2" value="{{ $initialState['design']['gradient_color_2'] }}" style="width:80px;height:40px;padding:4px;">
                            </div>
                        </div>
                        <label class="field-label">Direction</label>
                        <select class="form-field" id="sectionGradientType">
                            <option value="linear">Diagonal</option>
                            <option value="vertical">Top → Bottom</option>
                            <option value="horizontal">Left → Right</option>
                            <option value="radial">Radial</option>
                        </select>

                        <div class="form-section" style="margin-top:14px;">
                            <label class="field-label">Background Image (optional, shows behind gradient)</label>
                            <input type="file" class="form-field" id="sectionGradientImageInput" accept="image/*" onchange="previewImage(this, 'sectionGradientImagePreview')">
                            <img id="sectionGradientImagePreview" src="{{ $initialState['design']['background_image'] }}" style="display:{{ ($initialState['design']['background_type'] === 'gradient' && $initialState['design']['background_image']) ? '' : 'none' }};margin-top:8px;max-height:80px;border-radius:6px;border:1px solid var(--grey-200);">
                        </div>

                        <div class="form-section">
                            <label class="field-label">Gradient Opacity: <span id="sectionGradientOpacityVal">{{ $initialState['design']['gradient_opacity'] ?? 100 }}</span>%</label>
                            <input type="range" class="form-field" id="sectionGradientOpacity" min="0" max="100" value="{{ $initialState['design']['gradient_opacity'] ?? 100 }}" oninput="document.getElementById('sectionGradientOpacityVal').textContent = this.value">
                            <p style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">Lower opacity shows more of the image through the gradient.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Split layout: 2 images -->
            <div class="panel" id="splitPanel" style="margin-bottom:24px;display:none;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-images"></i> Images</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Featured Image Position</label>
                        <select class="form-field" id="splitFeaturedPosition" style="max-width:200px;">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Image 1 (plain featured image)</label>
                        <input type="file" class="form-field" id="splitImage1Input" accept="image/*" onchange="previewImage(this, 'splitImage1Preview')">
                        <input type="hidden" id="splitImage1Existing">
                        <img id="splitImage1Preview" style="display:none;margin-top:8px;max-height:120px;border-radius:6px;border:1px solid var(--grey-200);">
                    </div>

                    <hr style="border-color:var(--grey-200,#e5e7eb);margin:20px 0;">

                    <div class="form-section">
                        <label class="field-label">Image 2 (with bottom text overlay)</label>
                        <input type="file" class="form-field" id="splitImage2Input" accept="image/*" onchange="previewImage(this, 'splitImage2Preview')">
                        <input type="hidden" id="splitImage2Existing">
                        <img id="splitImage2Preview" style="display:none;margin-top:8px;max-height:120px;border-radius:6px;border:1px solid var(--grey-200);">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Image 2 — Icon (Font Awesome class)</label>
                        <div style="display:flex;gap:8px;">
                            <input type="text" class="form-field" id="splitImage2Icon" placeholder="e.g. fas fa-award" style="flex:1;">
                            <button type="button" class="btn-reset" onclick="openIconPicker(document.getElementById('splitImage2Icon'))" style="width:44px;flex-shrink:0;"><i class="fas fa-icons"></i></button>
                        </div>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Image 2 — Title</label>
                        <input type="text" class="form-field" id="splitImage2Heading" placeholder="e.g. Strong Accreditation">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Image 2 — Text</label>
                        <textarea class="form-field" id="splitImage2Subheading" rows="2" placeholder="Short overlay text"></textarea>
                    </div>
                </div>
            </div>

            <!-- Card layout: 4 fixed cards -->
            <div class="panel" id="cardPanel" style="margin-bottom:24px;display:none;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-grip"></i> Cards</h3>
                </div>
                <div class="panel-body" id="cardCardsContainer"></div>
            </div>

            <!-- Grid layout: repeatable icon boxes -->
            <div class="panel" id="gridPanel" style="margin-bottom:24px;display:none;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-icons"></i> Feature Boxes</h3>
                    <button type="button" class="btn-reset" onclick="addGridBox()"><i class="fas fa-plus"></i> Add Box</button>
                </div>
                <div class="panel-body" id="gridBoxesContainer"></div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <span class="btn-label"><i class="fas fa-floppy-disk"></i> Save</span>
                    <span class="spinner"></span>
                </button>
                <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            </div>
        </form>

        <div id="iconPickerModal" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,.5);z-index:9999;align-items:center;justify-content:center;">
            <div style="background:#fff;border-radius:10px;padding:20px;max-width:560px;width:92%;max-height:72vh;display:flex;flex-direction:column;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
                    <strong>Select an Icon</strong>
                    <button type="button" class="btn-reset" onclick="closeIconPicker()"><i class="fas fa-xmark"></i></button>
                </div>
                <input type="text" class="form-field" id="iconPickerSearch" placeholder="Search icons…" style="margin-bottom:12px;" oninput="filterIconPicker()">
                <div id="iconPickerGrid" style="display:grid;grid-template-columns:repeat(6,1fr);gap:10px;overflow-y:auto;"></div>
            </div>
        </div>
    </div>

    <script>
        const initial = @json($initialState);
        let gridUid = 0;

        const ICON_PICKER_LIST = [
            'fas fa-award', 'fas fa-star', 'fas fa-graduation-cap', 'fas fa-book', 'fas fa-book-open',
            'fas fa-chalkboard-teacher', 'fas fa-users', 'fas fa-user-graduate', 'fas fa-school', 'fas fa-laptop',
            'fas fa-globe', 'fas fa-shield-halved', 'fas fa-handshake', 'fas fa-rocket', 'fas fa-trophy',
            'fas fa-medal', 'fas fa-certificate', 'fas fa-briefcase', 'fas fa-building', 'fas fa-chart-line',
            'fas fa-clock', 'fas fa-heart', 'fas fa-thumbs-up', 'fas fa-lightbulb', 'fas fa-gem',
            'fas fa-flag', 'fas fa-globe-americas', 'fas fa-people-group', 'fas fa-money-check-dollar', 'fas fa-headset',
            'fas fa-comments', 'fas fa-puzzle-piece', 'fas fa-wifi', 'fas fa-microscope', 'fas fa-flask',
            'fas fa-paintbrush', 'fas fa-music', 'fas fa-camera', 'fas fa-video', 'fas fa-map-location-dot',
            'fas fa-bus', 'fas fa-utensils', 'fas fa-bed', 'fas fa-dumbbell', 'fas fa-futbol',
            'fas fa-pen', 'fas fa-calculator', 'fas fa-language', 'fas fa-globe-asia', 'fas fa-leaf',
            'fas fa-recycle', 'fas fa-hand-holding-heart', 'fas fa-bullseye', 'fas fa-clipboard-check', 'fas fa-magnifying-glass',
            'fas fa-gears', 'fas fa-server', 'fas fa-cloud', 'fas fa-mobile-screen', 'fas fa-key', 'fas fa-lock',
        ];

        let iconPickerTarget = null;

        function renderIconPickerGrid(list) {
            const grid = document.getElementById('iconPickerGrid');
            grid.innerHTML = list.map(cls => `
                <button type="button" onclick="chooseIcon('${cls}')" title="${cls}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:10px;background:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                    <i class="${cls}"></i>
                </button>
            `).join('');
        }

        function openIconPicker(inputEl) {
            iconPickerTarget = inputEl;
            document.getElementById('iconPickerSearch').value = '';
            renderIconPickerGrid(ICON_PICKER_LIST);
            document.getElementById('iconPickerModal').style.display = 'flex';
        }

        function closeIconPicker() {
            document.getElementById('iconPickerModal').style.display = 'none';
            iconPickerTarget = null;
        }

        function filterIconPicker() {
            const q = document.getElementById('iconPickerSearch').value.trim().toLowerCase();
            renderIconPickerGrid(q ? ICON_PICKER_LIST.filter(c => c.toLowerCase().includes(q)) : ICON_PICKER_LIST);
        }

        function chooseIcon(cls) {
            if (iconPickerTarget) {
                iconPickerTarget.value = cls;
            }
            closeIconPicker();
        }

        function escapeHtml(str) {
            return (str || '').replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
        }

        function previewImage(input, previewId) {
            const file = input.files && input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById(previewId);
                img.src = e.target.result;
                img.style.display = '';
            };
            reader.readAsDataURL(file);
        }

        function selectLayout(layout) {
            document.getElementById('layoutTypeField').value = layout;

            document.querySelectorAll('.layout-option').forEach(el => {
                el.style.borderColor = el.dataset.layout === layout ? 'var(--primary-600,#2563eb)' : 'var(--grey-200,#e5e7eb)';
            });

            document.getElementById('accentFieldsGroup').style.display = layout === 'split' ? '' : 'none';
            document.getElementById('ctaFieldsGroup').style.display = layout === 'split' ? '' : 'none';
            document.getElementById('headingColorGroup').style.display = layout === 'card' ? '' : 'none';
            document.getElementById('subheadingColorGroup').style.display = layout === 'card' ? '' : 'none';
            document.getElementById('backgroundPanel').style.display = layout === 'card' ? '' : 'none';

            document.getElementById('splitPanel').style.display = layout === 'split' ? '' : 'none';
            document.getElementById('cardPanel').style.display = layout === 'card' ? '' : 'none';
            document.getElementById('gridPanel').style.display = layout === 'grid' ? '' : 'none';

            document.getElementById('subheadingHint').style.display = layout === 'split' ? '' : 'none';
        }

        function toggleSectionBgFields(type) {
            document.getElementById('sectionBgColorWrap').style.display = type === 'color' ? '' : 'none';
            document.getElementById('sectionBgImageWrap').style.display = type === 'image' ? '' : 'none';
            document.getElementById('sectionBgGradientWrap').style.display = type === 'gradient' ? '' : 'none';
        }

        function toggleCustomLink() {
            const select = document.getElementById('ctaLinkSelect');
            document.getElementById('ctaLinkCustom').style.display = select.value === '__custom__' ? '' : 'none';
        }

        // Card layout: exactly 4 fixed icon cards
        function cardRowHtml(index, data) {
            data = data || {};
            return `
                <div class="card-row" data-index="${index}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;margin-bottom:16px;">
                    <strong style="display:block;font-size:.86rem;margin-bottom:10px;">Card #${index + 1}</strong>
                    <div class="form-section" style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Icon (Font Awesome class)</label>
                            <div style="display:flex;gap:8px;">
                                <input type="text" class="form-field card-icon" placeholder="e.g. fas fa-award" value="${escapeHtml(data.icon)}" style="flex:1;">
                                <button type="button" class="btn-reset" onclick="openIconPicker(this.previousElementSibling)" style="width:44px;flex-shrink:0;"><i class="fas fa-icons"></i></button>
                            </div>
                        </div>
                        <div>
                            <label class="field-label">Icon Color</label>
                            <input type="color" class="form-field card-icon-color" value="${data.icon_color || '#2563eb'}" style="width:70px;height:40px;padding:4px;">
                        </div>
                        <div>
                            <label class="field-label">Icon Background</label>
                            <input type="color" class="form-field card-icon-bg" value="${data.icon_bg_color || '#eff6ff'}" style="width:70px;height:40px;padding:4px;">
                        </div>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field card-heading" placeholder="e.g. Strong Accreditation" value="${escapeHtml(data.heading)}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Subheading</label>
                        <textarea class="form-field card-subheading" rows="2" placeholder="Short description">${escapeHtml(data.subheading)}</textarea>
                    </div>
                </div>
            `;
        }

        function renderCardCards() {
            const container = document.getElementById('cardCardsContainer');
            const existing = (initial.layout_type === 'card' ? initial.cards : []) || [];
            let html = '';
            for (let i = 0; i < 4; i++) {
                html += cardRowHtml(i, existing[i]);
            }
            container.innerHTML = html;
        }

        // Grid layout: repeatable icon boxes
        function gridBoxHtml(uid, data) {
            data = data || {};
            return `
                <div class="grid-box-item" data-uid="${uid}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong class="grid-box-label" style="font-size:.86rem;"></strong>
                        <button type="button" class="btn-reset" onclick="removeGridBox('${uid}')"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Icon (Font Awesome / Bootstrap Icons class)</label>
                        <div style="display:flex;gap:8px;">
                            <input type="text" class="form-field gridbox-icon" placeholder="e.g. fas fa-graduation-cap" value="${escapeHtml(data.icon)}" style="flex:1;">
                            <button type="button" class="btn-reset" onclick="openIconPicker(this.previousElementSibling)" style="width:44px;flex-shrink:0;"><i class="fas fa-icons"></i></button>
                        </div>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field gridbox-heading" placeholder="e.g. Skill Development" value="${escapeHtml(data.heading)}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Paragraph</label>
                        <textarea class="form-field gridbox-subheading" rows="2" placeholder="Short description">${escapeHtml(data.subheading)}</textarea>
                    </div>
                </div>
            `;
        }

        function renumberGridBoxes() {
            document.querySelectorAll('.grid-box-item').forEach((el, idx) => {
                el.querySelector('.grid-box-label').textContent = 'Box #' + (idx + 1);
            });
        }

        function addGridBox(data) {
            gridUid++;
            const uid = gridUid;
            document.getElementById('gridBoxesContainer').insertAdjacentHTML('beforeend', gridBoxHtml(uid, data));
            renumberGridBoxes();
        }

        function removeGridBox(uid) {
            const el = document.querySelector(`.grid-box-item[data-uid="${uid}"]`);
            if (el) el.remove();
            renumberGridBoxes();
        }

        document.getElementById('whyChooseUsForm').addEventListener('submit', function () {
            const layout = document.getElementById('layoutTypeField').value;

            const payload = {
                badge: document.getElementById('badgeField').value.trim(),
                heading: document.getElementById('headingField').value.trim(),
                subheading: document.getElementById('subheadingField').value.trim(),
                layout_type: layout,
                design: { background_type: 'color', background_color: '#ffffff' },
                cards: [],
            };

            if (layout === 'split') {
                payload.heading_accent_text = document.getElementById('headingAccentTextField').value.trim();
                payload.heading_accent_color = document.getElementById('headingAccentColorField').value;
                payload.cta_text = document.getElementById('ctaTextField').value.trim();
                const linkSelect = document.getElementById('ctaLinkSelect').value;
                payload.cta_link = linkSelect === '__custom__' ? document.getElementById('ctaLinkCustom').value.trim() : linkSelect;
                payload.split = { featured_position: document.getElementById('splitFeaturedPosition').value };

                payload.cards.push({
                    layout: 'split',
                    card_type: 'image',
                    is_featured: true,
                    background_type: 'image',
                    existing_background_image: document.getElementById('splitImage1Existing').value || null,
                });
                document.getElementById('splitImage1Input').name = 'cards[0][background_image]';

                payload.cards.push({
                    layout: 'split',
                    card_type: 'image',
                    is_featured: false,
                    background_type: 'image',
                    image_overlay_opacity: 40,
                    icon: document.getElementById('splitImage2Icon').value.trim(),
                    heading: document.getElementById('splitImage2Heading').value.trim(),
                    subheading: document.getElementById('splitImage2Subheading').value.trim(),
                    existing_background_image: document.getElementById('splitImage2Existing').value || null,
                });
                document.getElementById('splitImage2Input').name = 'cards[1][background_image]';
            }

            if (layout === 'card') {
                payload.heading_color = document.getElementById('headingColorField').value;
                payload.subheading_color = document.getElementById('subheadingColorField').value;

                const bgType = document.querySelector('input[name="sectionBgType"]:checked')?.value || 'color';
                payload.design = {
                    background_type: bgType,
                    background_color: document.getElementById('sectionBgColor').value,
                    gradient_type: document.getElementById('sectionGradientType').value,
                    gradient_color_1: document.getElementById('sectionGradientColor1').value,
                    gradient_color_2: document.getElementById('sectionGradientColor2').value,
                    gradient_opacity: parseInt(document.getElementById('sectionGradientOpacity').value, 10),
                    existing_background_image: (initial.design && initial.design.existing_background_image) || null,
                };

                const bgImageInput = document.getElementById('sectionBgImageInput');
                const gradientImageInput = document.getElementById('sectionGradientImageInput');
                bgImageInput.removeAttribute('name');
                gradientImageInput.removeAttribute('name');
                if (bgType === 'image') {
                    bgImageInput.name = 'section_background_image';
                } else if (bgType === 'gradient') {
                    gradientImageInput.name = 'section_background_image';
                }

                document.querySelectorAll('#cardCardsContainer .card-row').forEach((row, idx) => {
                    payload.cards.push({
                        layout: 'card',
                        card_type: 'icon',
                        icon: row.querySelector('.card-icon').value.trim(),
                        icon_color: row.querySelector('.card-icon-color').value,
                        icon_bg_color: row.querySelector('.card-icon-bg').value,
                        heading: row.querySelector('.card-heading').value.trim(),
                        subheading: row.querySelector('.card-subheading').value.trim(),
                        background_type: 'color',
                    });
                });

                payload.card_view = { columns: 4 };
            }

            if (layout === 'grid') {
                document.querySelectorAll('#gridBoxesContainer .grid-box-item').forEach(el => {
                    payload.cards.push({
                        layout: 'grid',
                        card_type: 'icon',
                        icon: el.querySelector('.gridbox-icon').value.trim(),
                        heading: el.querySelector('.gridbox-heading').value.trim(),
                        subheading: el.querySelector('.gridbox-subheading').value.trim(),
                        background_type: 'color',
                    });
                });
            }

            document.getElementById('payloadField').value = JSON.stringify(payload);
        });

        // Initial state
        (function () {
            document.getElementById('headingAccentTextField').value = initial.heading_accent_text || '';
            document.getElementById('headingAccentColorField').value = initial.heading_accent_color || '#2563eb';
            document.getElementById('headingColorField').value = initial.heading_color || '#0f172a';
            document.getElementById('subheadingColorField').value = initial.subheading_color || '#6b7280';
            document.getElementById('ctaTextField').value = initial.cta_text || '';

            const sectionBgType = (initial.design && initial.design.background_type) || 'color';
            document.querySelector(`input[name="sectionBgType"][value="${sectionBgType}"]`).checked = true;
            document.getElementById('sectionBgColor').value = (initial.design && initial.design.background_color) || '#ffffff';
            toggleSectionBgFields(sectionBgType);

            document.getElementById('splitFeaturedPosition').value = (initial.split && initial.split.featured_position) || 'left';

            if (initial.layout_type === 'split' && (initial.cards || []).length) {
                const img1 = initial.cards[0];
                if (img1) {
                    document.getElementById('splitImage1Existing').value = img1.existing_background_image || '';
                    if (img1.background_image) {
                        document.getElementById('splitImage1Preview').src = img1.background_image;
                        document.getElementById('splitImage1Preview').style.display = '';
                    }
                }
                const img2 = initial.cards[1];
                if (img2) {
                    document.getElementById('splitImage2Existing').value = img2.existing_background_image || '';
                    document.getElementById('splitImage2Icon').value = img2.icon || '';
                    document.getElementById('splitImage2Heading').value = img2.heading || '';
                    document.getElementById('splitImage2Subheading').value = img2.subheading || '';
                    if (img2.background_image) {
                        document.getElementById('splitImage2Preview').src = img2.background_image;
                        document.getElementById('splitImage2Preview').style.display = '';
                    }
                }
            }

            renderCardCards();

            if (initial.layout_type === 'grid' && (initial.cards || []).length) {
                initial.cards.forEach(addGridBox);
            } else {
                addGridBox();
            }

            selectLayout(initial.layout_type || 'grid');

            if (initial.cta_link) {
                const select = document.getElementById('ctaLinkSelect');
                const match = Array.from(select.options).find(o => o.value === initial.cta_link);
                if (match) {
                    select.value = initial.cta_link;
                } else {
                    select.value = '__custom__';
                    document.getElementById('ctaLinkCustom').value = initial.cta_link;
                    toggleCustomLink();
                }
            }
        })();
    </script>

@endsection
