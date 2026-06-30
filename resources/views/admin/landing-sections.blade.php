@extends('adminlayout.app')
@section('title', 'Landing Sections')
@section('adminContent')

    <style>
        .row {
            display: flex;
            flex-wrap: wrap
        }

        .col-md-6 {
            width: 49%;
            padding: 0px 0.25rem;
        }
    </style>

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Landing Sections</h2>
                <p>Choose a screen type for your site's landing page and configure its content and background.</p>
            </div>
        </div>

        @if (session('success'))
            <div class="field-error show"
                style="background:var(--green-50,#f0fdf4);color:var(--green-600,#16a34a);padding:12px 16px;border-radius:8px;margin-bottom:18px;">
                <i class="fas fa-circle-check"></i>&nbsp; {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="field-error show"
                style="background:#fef2f2;color:var(--red-600);padding:12px 16px;border-radius:8px;margin-bottom:18px;display:block;">
                <i class="fas fa-triangle-exclamation"></i>&nbsp; {{ $errors->first() }}
            </div>
        @endif

        <form id="landingForm" method="POST" action="{{ route('admin.landing-sections.store') }}"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payload" id="payloadField">

            <!-- Screen type -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-display"></i> Screen Style</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:16px;flex-wrap:wrap;">
                        <label
                            style="flex:1;min-width:200px;border:1px solid var(--grey-200);border-radius:8px;padding:14px;cursor:pointer;display:flex;gap:10px;align-items:flex-start;">
                            <input type="radio" name="screenType" value="single" id="screenSingle"
                                onchange="toggleScreenType(this.value)" style="margin-top:3px;">
                            <span>
                                <strong style="display:block;font-size:.88rem;"><i class="fas fa-image"></i> Single
                                    Screen</strong>
                                <span style="font-size:.78rem;color:var(--grey-500,#6b7280);">One fixed hero screen with
                                    heading, subheading and buttons.</span>
                            </span>
                        </label>
                        <label
                            style="flex:1;min-width:200px;border:1px solid var(--grey-200);border-radius:8px;padding:14px;cursor:pointer;display:flex;gap:10px;align-items:flex-start;">
                            <input type="radio" name="screenType" value="slider" id="screenSlider"
                                onchange="toggleScreenType(this.value)" style="margin-top:3px;">
                            <span>
                                <strong style="display:block;font-size:.88rem;"><i class="fas fa-images"></i> Slider
                                    Screen</strong>
                                <span style="font-size:.78rem;color:var(--grey-500,#6b7280);">Multiple slides that rotate
                                    automatically like a carousel.</span>
                            </span>
                        </label>
                        <label
                            style="flex:1;min-width:200px;border:1px solid var(--grey-200);border-radius:8px;padding:14px;cursor:pointer;display:flex;gap:10px;align-items:flex-start;">
                            <input type="radio" name="screenType" value="scroll" id="screenScroll"
                                onchange="toggleScreenType(this.value)" style="margin-top:3px;">
                            <span>
                                <strong style="display:block;font-size:.88rem;"><i
                                        class="fas fa-arrow-down-up-across-line"></i> Scroll Screen</strong>
                                <span style="font-size:.78rem;color:var(--grey-500,#6b7280);">Multiple screens that stack
                                    and reveal one by one as the visitor scrolls.</span>
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Single screen content -->
            <div class="panel" id="singleContentPanel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-pen-to-square"></i> Screen Content</h3>
                </div>
                <div class="panel-body" id="mainContentBody"></div>
            </div>

            <!-- Slides -->
            <div class="panel" id="slidesPanel" style="margin-bottom:24px;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-images"></i> Slides</h3>
                    <button type="button" class="btn-reset" onclick="addSlide()">
                        <i class="fas fa-plus"></i> Add Slide
                    </button>
                </div>
                <div class="panel-body">
                    <p id="slidesHint"
                        style="font-size:.78rem;color:var(--grey-500,#6b7280);margin-top:0;margin-bottom:14px;"></p>
                    <div id="slidesContainer"></div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <span class="btn-label"><i class="fas fa-floppy-disk"></i> Save Landing Section</span>
                    <span class="spinner"></span>
                </button>
                <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            </div>
        </form>
    </div>

    <script>
        const initial = @json($initialState);
        let slideUid = 0;

        function escapeHtml(str) {
            return (str || '').replace(/[&<>"']/g, c => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [c]));
        }

        function positionFieldHtml(name, value) {
            value = value || 'left';
            return `
                <div class="form-section">
                    <label class="field-label">Position</label>
                    <div style="display:flex;gap:18px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="${name}" value="left" ${value === 'left' ? 'checked' : ''}> Left
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="${name}" value="center" ${value === 'center' ? 'checked' : ''}> Center
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="${name}" value="right" ${value === 'right' ? 'checked' : ''}> Right
                        </label>
                    </div>
                </div>
            `;
        }

        const GRADIENT_OPTIONS = [
            ['solid', 'Solid (flat tint)'],
            ['top', 'Top → Bottom'],
            ['bottom', 'Bottom → Top'],
            ['left', 'Left → Right'],
            ['right', 'Right → Left'],
            ['diagonal', 'Diagonal'],
            ['radial', 'Radial (center out)'],
        ];

        function backgroundBlockHtml(uid, bg) {




            bg = bg || {};
            const type = bg.type || 'color';
            const color = bg.color || '#2563eb';
            const gradient = bg.gradient || 'solid';
            const fade = bg.fade_opacity ?? 50;
            const image = bg.image || '';
            const existingImage = bg.existing_image || '';

            return `
                <div class="form-section row" >
                    <div class="col-md-6"> 
                        <label class="field-label">Background</label>
                        <div style="display:flex;gap:18px;margin-bottom:12px;">
                            <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                <input type="radio" name="bgtype-${uid}" value="color" ${type === 'color' ? 'checked' : ''} onchange="toggleBackgroundFields('${uid}', this.value)"> Color
                            </label>
                            <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                <input type="radio" name="bgtype-${uid}" value="image" ${type === 'image' ? 'checked' : ''} onchange="toggleBackgroundFields('${uid}', this.value)"> Image
                            </label>
                            <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                <input type="radio" name="bgtype-${uid}" value="image_fade" ${type === 'image_fade' ? 'checked' : ''} onchange="toggleBackgroundFields('${uid}', this.value)"> Image + Fade Color
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="bg-color-wrap" data-uid="${uid}" style="display:${type === 'color' || type === 'image_fade' ? '' : 'none'};margin-bottom:12px;max-width:200px;">
                            <label class="field-label bg-color-label" data-uid="${uid}">${type === 'image_fade' ? 'Fade Overlay Color' : 'Background Color'}</label>
                            <input type="color" class="form-field bg-color-input" data-uid="${uid}" value="${color}" style="width:80px;height:40px;padding:4px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-image-wrap" data-uid="${uid}" style="display:${type === 'image' || type === 'image_fade' ? '' : 'none'};margin-bottom:12px;">
                            <label class="field-label">Background Image</label>
                            <input type="file" class="form-field bg-image-input" data-uid="${uid}" accept="image/*" onchange="previewBgImage(this, '${uid}')">
                            <input type="hidden" class="bg-existing-image" data-uid="${uid}" value="${escapeHtml(existingImage)}">
                            <img class="bg-preview-img" data-uid="${uid}" src="${image}" style="display:${image ? '' : 'none'};margin-top:8px;max-height:80px;border-radius:6px;border:1px solid var(--grey-200);">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-fade-wrap" data-uid="${uid}" style="display:${type === 'image_fade' ? '' : 'none'};">
                            <div style="margin-bottom:12px;">
                                <label class="field-label">Gradient Style</label>
                                <select class="form-field bg-gradient-select" data-uid="${uid}">
                                    ${GRADIENT_OPTIONS.map(([value, label]) => `<option value="${value}" ${gradient === value ? 'selected' : ''}>${label}</option>`).join('')}
                                </select>
                            </div>
                            <label class="field-label">Color Opacity: <span class="bg-fade-value" data-uid="${uid}">${fade}</span>%</label>
                            <input type="range" class="form-field bg-fade-input" data-uid="${uid}" min="0" max="100" value="${fade}"
                                oninput="document.querySelector('.bg-fade-value[data-uid=\\'${uid}\\']').textContent = this.value">
                            <p style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">Lower opacity shows more of the image through the tint/gradient.</p>
                        </div>
                    </div>
                </div>
            `;
        }

        function toggleBackgroundFields(uid, type) {
            document.querySelector(`.bg-color-wrap[data-uid="${uid}"]`).style.display = (type === 'color' || type ===
                'image_fade') ? '' : 'none';
            document.querySelector(`.bg-image-wrap[data-uid="${uid}"]`).style.display = (type === 'image' || type ===
                'image_fade') ? '' : 'none';
            document.querySelector(`.bg-fade-wrap[data-uid="${uid}"]`).style.display = (type === 'image_fade') ? '' :
                'none';
            document.querySelector(`.bg-color-label[data-uid="${uid}"]`).textContent = (type === 'image_fade') ?
                'Fade Overlay Color' : 'Background Color';
        }

        function previewBgImage(input, uid) {
            const file = input.files && input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.querySelector(`.bg-preview-img[data-uid="${uid}"]`);
                img.src = e.target.result;
                img.style.display = '';
            };
            reader.readAsDataURL(file);
        }

        function collectBackground(uid) {
            return {
                type: document.querySelector(`input[name="bgtype-${uid}"]:checked`).value,
                color: document.querySelector(`.bg-color-input[data-uid="${uid}"]`).value,
                gradient: document.querySelector(`.bg-gradient-select[data-uid="${uid}"]`).value,
                fade_opacity: parseInt(document.querySelector(`.bg-fade-input[data-uid="${uid}"]`).value) || 50,
                existing_image: document.querySelector(`.bg-existing-image[data-uid="${uid}"]`).value || null,
            };
        }

        function buttonRowHtml(btn) {
            btn = btn || {};
            return `
                <div class="button-row" style="display:flex;gap:10px;margin-top:8px;align-items:center;">
                    <input type="text" class="form-field btn-label-input" placeholder="Button label" value="${escapeHtml(btn.label)}">
                    <input type="text" class="form-field btn-link-input" placeholder="https://example.com" value="${escapeHtml(btn.link || '')}">
                    <button type="button" class="btn-reset" onclick="this.closest('.button-row').remove()"><i class="fas fa-trash"></i></button>
                </div>
            `;
        }

        function buttonsBlockHtml(uid, buttons) {
            buttons = buttons || [];
            return `
                <div class="form-section">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
                        <label class="field-label" style="margin:0;">Buttons</label>
                        <button type="button" class="btn-reset" onclick="addButtonRow('${uid}')"><i class="fas fa-plus"></i> Add Button</button>
                    </div>
                    <div class="buttons-list" data-uid="${uid}">
                        ${buttons.map(buttonRowHtml).join('')}
                    </div>
                </div>
            `;
        }

        function addButtonRow(uid) {
            document.querySelector(`.buttons-list[data-uid="${uid}"]`).insertAdjacentHTML('beforeend', buttonRowHtml());
        }

        function collectButtons(uid) {
            const container = document.querySelector(`.buttons-list[data-uid="${uid}"]`);
            return Array.from(container.querySelectorAll('.button-row')).map(row => ({
                label: row.querySelector('.btn-label-input').value.trim(),
                link: row.querySelector('.btn-link-input').value.trim(),
            })).filter(b => b.label);
        }

        // Main (single screen) content
        function renderMainContent() {
            document.getElementById('mainContentBody').innerHTML = `
                <div class="form-section">
                    <label class="field-label">Heading</label>
                    <input type="text" class="form-field" id="mainHeading" placeholder="e.g. Welcome to Our Institution" value="${escapeHtml(initial.heading)}">
                </div>
                <div class="form-section">
                    <label class="field-label">Subheading</label>
                    <textarea class="form-field" id="mainSubheading" rows="2" placeholder="Short supporting text">${escapeHtml(initial.subheading)}</textarea>
                </div>
                ${positionFieldHtml('position-main', initial.position)}
                ${buttonsBlockHtml('main', initial.buttons)}
                ${backgroundBlockHtml('main', initial.background)}
            `;
        }

        // Slides (slider / scroll)
        function slideTemplateHtml(uid, data) {
            data = data || {};
            return `
                <div class="slide-item" data-uid="${uid}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong class="slide-label" style="font-size:.86rem;"></strong>
                        <button type="button" class="btn-reset" onclick="removeSlide('${uid}')"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field slide-heading" placeholder="e.g. Admissions Open 2026-27" value="${escapeHtml(data.heading)}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Subheading</label>
                        <textarea class="form-field slide-subheading" rows="2" placeholder="Short supporting text">${escapeHtml(data.subheading)}</textarea>
                    </div>
                    ${positionFieldHtml('position-slide-' + uid, data.position)}
                    ${buttonsBlockHtml('slide-' + uid, data.buttons)}
                    ${backgroundBlockHtml('slide-' + uid, data.background)}
                </div>
            `;
        }

        function renumberSlides() {
            document.querySelectorAll('.slide-item').forEach((el, idx) => {
                el.querySelector('.slide-label').textContent = 'Slide #' + (idx + 1);
            });
        }

        function addSlide(data) {
            slideUid++;
            const uid = slideUid;
            document.getElementById('slidesContainer').insertAdjacentHTML('beforeend', slideTemplateHtml(uid, data));
            renumberSlides();
        }

        function removeSlide(uid) {
            const el = document.querySelector(`.slide-item[data-uid="${uid}"]`);
            if (el) el.remove();
            renumberSlides();
        }

        function toggleScreenType(type) {
            document.getElementById('singleContentPanel').style.display = type === 'single' ? '' : 'none';
            document.getElementById('slidesPanel').style.display = type === 'single' ? 'none' : '';
            document.getElementById('slidesHint').textContent = type === 'slider' ?
                'Slides rotate automatically like a carousel.' :
                'Slides stack and reveal one after another as the visitor scrolls.';

            if (type !== 'single' && document.querySelectorAll('.slide-item').length === 0) {
                addSlide();
            }
        }

        document.getElementById('landingForm').addEventListener('submit', function() {
            const screenType = document.querySelector('input[name="screenType"]:checked').value;
            const payload = {
                screen_type: screenType
            };

            if (screenType === 'single') {
                payload.heading = document.getElementById('mainHeading').value.trim();
                payload.subheading = document.getElementById('mainSubheading').value.trim();
                payload.position = document.querySelector('input[name="position-main"]:checked').value;
                payload.buttons = collectButtons('main');
                payload.background = collectBackground('main');

                const mainBgInput = document.querySelector('.bg-image-input[data-uid="main"]');
                mainBgInput.name = 'background_image';
            } else {
                payload.slides = [];
                document.querySelectorAll('.slide-item').forEach((el, idx) => {
                    const uid = el.dataset.uid;
                    payload.slides.push({
                        heading: el.querySelector('.slide-heading').value.trim(),
                        subheading: el.querySelector('.slide-subheading').value.trim(),
                        position: el.querySelector(`input[name="position-slide-${uid}"]:checked`)
                            .value,
                        buttons: collectButtons('slide-' + uid),
                        background: collectBackground('slide-' + uid),
                    });

                    const fileInput = el.querySelector(`.bg-image-input[data-uid="slide-${uid}"]`);
                    fileInput.name = `slides[${idx}][background_image]`;
                });
            }

            document.getElementById('payloadField').value = JSON.stringify(payload);
        });

        // Initial render
        const initialType = initial.screen_type || 'single';
        document.getElementById(initialType === 'slider' ? 'screenSlider' : (initialType === 'scroll' ? 'screenScroll' :
            'screenSingle')).checked = true;
        renderMainContent();
        (initial.slides || []).forEach(addSlide);
        toggleScreenType(initialType);
    </script>

@endsection
