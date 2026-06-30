@extends('adminlayout.app')
@section('title', 'Courses')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Courses</h2>
                <p>Add a heading, subheading and pick a design. Changes apply to the "Courses" section on the home page.</p>
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

        <form id="courseSectionForm" method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payload" id="payloadField">
            <input type="hidden" name="design_type" id="designTypeField" value="{{ $initialState['design_type'] }}">

            <!-- Design picker -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-table-cells-large"></i> Design</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div class="design-option" data-design="grid" onclick="selectDesign('grid')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:10px;cursor:pointer;">
                            <img src="{{ asset('images/program/program_1.PNG') }}" style="width:100%;height:140px;object-fit:cover;border-radius:6px;display:block;margin-bottom:8px;">
                            <strong style="display:block;font-size:.86rem;text-align:center;">1 Row · 4 Cards (Add More)</strong>
                        </div>
                        <div class="design-option" data-design="image" onclick="selectDesign('image')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:10px;cursor:pointer;">
                            <img src="{{ asset('images/program/program_2.png') }}" style="width:100%;height:140px;object-fit:cover;border-radius:6px;display:block;margin-bottom:8px;">
                            <strong style="display:block;font-size:.86rem;text-align:center;">Program Card + Image</strong>
                        </div>
                        <div class="design-option" data-design="slider" onclick="selectDesign('slider')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:10px;cursor:pointer;">
                            <img src="{{ asset('images/program/program_3.PNG') }}" style="width:100%;height:140px;object-fit:cover;border-radius:6px;display:block;margin-bottom:8px;">
                            <strong style="display:block;font-size:.86rem;text-align:center;">1 Row · 3 Cards (Slick Slider)</strong>
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
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field" id="headingField" placeholder="e.g. Our Courses" value="{{ $initialState['heading'] }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Subheading</label>
                        <textarea class="form-field" id="subheadingField" rows="3" placeholder="Short description shown under the heading">{{ $initialState['subheading'] }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section Image (design = image only) -->
            <div class="panel" id="sectionImagePanel" style="margin-bottom:24px;display:none;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-image"></i> Program Image</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Image</label>
                        <input type="file" class="form-field" id="sectionImageInput" accept="image/*" onchange="previewImage(this, 'sectionImagePreview')">
                        <input type="hidden" id="sectionImageExisting" value="{{ $initialState['existing_image'] }}">
                        <img id="sectionImagePreview" src="{{ $initialState['image'] }}" style="display:{{ $initialState['image'] ? '' : 'none' }};margin-top:8px;max-height:140px;border-radius:6px;border:1px solid var(--grey-200);">
                    </div>
                    <div class="form-section" style="max-width:240px;">
                        <label class="field-label">Image Position</label>
                        <select class="form-field" id="sectionImagePosition">
                            <option value="left">Left</option>
                            <option value="right">Right</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Cards -->
            <div class="panel" id="cardsPanel" style="margin-bottom:24px;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-grip"></i> Program Cards</h3>
                    <button type="button" class="btn-reset" onclick="addCard()"><i class="fas fa-plus"></i> Add More</button>
                </div>
                <div class="panel-body" id="cardsContainer"></div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <span class="btn-label"><i class="fas fa-floppy-disk"></i> Save</span>
                    <span class="spinner"></span>
                </button>
                <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            </div>
        </form>
    </div>

    <script>
        const initial = @json($initialState);
        let cardUid = 0;

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

        function selectDesign(design) {
            document.getElementById('designTypeField').value = design;

            document.querySelectorAll('.design-option').forEach(el => {
                el.style.borderColor = el.dataset.design === design ? 'var(--primary-600,#2563eb)' : 'var(--grey-200,#e5e7eb)';
            });

            document.getElementById('sectionImagePanel').style.display = design === 'image' ? '' : 'none';

            document.querySelectorAll('.card-image-block').forEach(el => {
                el.style.display = (design === 'grid' || design === 'slider') ? '' : 'none';
            });
            document.querySelectorAll('.card-bgcolor-block').forEach(el => {
                el.style.display = design === 'slider' ? '' : 'none';
            });
            document.querySelectorAll('.card-badge-block').forEach(el => {
                el.style.display = design === 'image' ? 'none' : '';
            });
            document.querySelectorAll('.card-short-description-block').forEach(el => {
                el.style.display = design === 'image' ? '' : 'none';
            });
        }

        function cardHtml(uid, data) {
            data = data || {};
            const imageSrc = data.image || '';
            const design = initial.design_type || 'grid';
            return `
                <div class="card-item" data-uid="${uid}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong class="card-label" style="font-size:.86rem;"></strong>
                        <button type="button" class="btn-reset" onclick="removeCard('${uid}')"><i class="fas fa-trash"></i> Remove</button>
                    </div>

                    <div class="card-image-block form-section" style="display:${(design === 'grid' || design === 'slider') ? '' : 'none'};">
                        <label class="field-label">Image</label>
                        <input type="file" class="form-field card-image-input" accept="image/*" onchange="previewImage(this, 'cardImgPreview-${uid}')">
                        <input type="hidden" class="card-image-existing" value="${escapeHtml(data.existing_image)}">
                        <img id="cardImgPreview-${uid}" src="${imageSrc}" style="display:${imageSrc ? '' : 'none'};margin-top:8px;max-height:100px;border-radius:6px;border:1px solid var(--grey-200);">
                    </div>

                    <div class="card-bgcolor-block form-section" style="display:${design === 'slider' ? '' : 'none'};max-width:200px;">
                        <label class="field-label">Card Background Color</label>
                        <input type="color" class="form-field card-bg-color" value="${data.background_color || '#ffffff'}" style="width:80px;height:40px;padding:4px;">
                    </div>

                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field card-heading" placeholder="e.g. Web Development" value="${escapeHtml(data.heading)}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Subheading</label>
                        <textarea class="form-field card-subheading" rows="2" placeholder="Short subheading">${escapeHtml(data.subheading)}</textarea>
                    </div>
                    <div class="card-short-description-block form-section" style="display:${design === 'image' ? '' : 'none'};">
                        <label class="field-label">Short Description</label>
                        <textarea class="form-field card-short-description" rows="3" placeholder="Short description">${escapeHtml(data.short_description)}</textarea>
                    </div>
                    <div class="form-section" style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Course Type</label>
                            <select class="form-field card-course-type">
                                <option value="">— Select —</option>
                                <option value="full_time" ${data.course_type === 'full_time' ? 'selected' : ''}>Full Time</option>
                                <option value="part_time" ${data.course_type === 'part_time' ? 'selected' : ''}>Part Time</option>
                            </select>
                        </div>
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Duration</label>
                            <input type="text" class="form-field card-duration" placeholder="e.g. 6 Months" value="${escapeHtml(data.duration)}">
                        </div>
                    </div>
                    <div class="card-badge-block form-section" style="display:${design === 'image' ? 'none' : ''};">
                        <label class="field-label">Program Badge</label>
                        <input type="text" class="form-field card-badge" placeholder="e.g. New / Popular" value="${escapeHtml(data.badge)}">
                    </div>
                    <div class="form-section" style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Explore Button Text</label>
                            <input type="text" class="form-field card-explore-text" placeholder="e.g. Explore" value="${escapeHtml(data.explore_text)}">
                        </div>
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Explore Button Link</label>
                            <input type="text" class="form-field card-explore-link" placeholder="https://example.com" value="${escapeHtml(data.explore_link)}">
                        </div>
                    </div>
                </div>
            `;
        }

        function renumberCards() {
            document.querySelectorAll('.card-item').forEach((el, idx) => {
                el.querySelector('.card-label').textContent = 'Card #' + (idx + 1);
            });
        }

        function addCard(data) {
            cardUid++;
            const uid = cardUid;
            document.getElementById('cardsContainer').insertAdjacentHTML('beforeend', cardHtml(uid, data));
            renumberCards();
        }

        function removeCard(uid) {
            const el = document.querySelector(`.card-item[data-uid="${uid}"]`);
            if (el) el.remove();
            renumberCards();
        }

        document.getElementById('courseSectionForm').addEventListener('submit', function () {
            const design = document.getElementById('designTypeField').value;

            const payload = {
                heading: document.getElementById('headingField').value.trim(),
                subheading: document.getElementById('subheadingField').value.trim(),
                design_type: design,
                image_position: document.getElementById('sectionImagePosition').value,
                existing_image: document.getElementById('sectionImageExisting').value || null,
                cards: [],
            };

            const sectionImageInput = document.getElementById('sectionImageInput');
            if (design === 'image') {
                sectionImageInput.name = 'image';
            } else {
                sectionImageInput.removeAttribute('name');
            }

            document.querySelectorAll('#cardsContainer .card-item').forEach((row, idx) => {
                payload.cards.push({
                    heading: row.querySelector('.card-heading').value.trim(),
                    subheading: row.querySelector('.card-subheading').value.trim(),
                    short_description: row.querySelector('.card-short-description').value.trim(),
                    course_type: row.querySelector('.card-course-type').value,
                    duration: row.querySelector('.card-duration').value.trim(),
                    badge: row.querySelector('.card-badge').value.trim(),
                    explore_text: row.querySelector('.card-explore-text').value.trim(),
                    explore_link: row.querySelector('.card-explore-link').value.trim(),
                    background_color: row.querySelector('.card-bg-color').value,
                    existing_image: row.querySelector('.card-image-existing').value || null,
                });

                const imageInput = row.querySelector('.card-image-input');
                if (design === 'grid' || design === 'slider') {
                    imageInput.name = `cards[${idx}][image]`;
                } else {
                    imageInput.removeAttribute('name');
                }
            });

            document.getElementById('payloadField').value = JSON.stringify(payload);
        });

        // Initial state
        (function () {
            document.getElementById('sectionImagePosition').value = initial.image_position || 'left';

            if ((initial.cards || []).length) {
                initial.cards.forEach(addCard);
            } else {
                for (let i = 0; i < 4; i++) addCard();
            }

            selectDesign(initial.design_type || 'grid');
        })();
    </script>

@endsection
