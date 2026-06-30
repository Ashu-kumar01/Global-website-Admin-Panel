@extends('adminlayout.app')
@section('title', 'Admission Process')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Admission Process</h2>
                <p>Add a heading, subheading and the step-by-step admission timeline. Changes apply to the "Admission Process" section on the home page.</p>
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

        <form id="admissionProcessForm" method="POST" action="{{ route('admin.admission-process.store') }}">
            @csrf
            <input type="hidden" name="payload" id="payloadField">

            <!-- Shared header fields -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-heading"></i> Section Header</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Badge</label>
                        <input type="text" class="form-field" id="badgeField" placeholder="e.g. How to Apply" value="{{ $initialState['badge'] }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field" id="headingField" placeholder="e.g. Admission Process" value="{{ $initialState['heading'] }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Subheading</label>
                        <textarea class="form-field" id="subheadingField" rows="3" placeholder="Short description shown under the heading">{{ $initialState['subheading'] }}</textarea>
                    </div>
                    <div class="form-section" style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Button Text</label>
                            <input type="text" class="form-field" id="ctaTextField" placeholder="e.g. Apply Now" value="{{ $initialState['cta_text'] }}">
                        </div>
                        <div style="flex:1;min-width:160px;">
                            <label class="field-label">Button Link</label>
                            <input type="text" class="form-field" id="ctaLinkField" placeholder="https://example.com" value="{{ $initialState['cta_link'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Steps -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-list-ol"></i> Steps</h3>
                    <button type="button" class="btn-reset" onclick="addStep()"><i class="fas fa-plus"></i> Add Step</button>
                </div>
                <div class="panel-body" id="stepsContainer"></div>
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
        let stepUid = 0;

        const ICON_PICKER_LIST = [
            'fas fa-file-signature', 'fas fa-clipboard-list', 'fas fa-clipboard-check', 'fas fa-user-plus',
            'fas fa-id-card', 'fas fa-pen-to-square', 'fas fa-upload', 'fas fa-credit-card', 'fas fa-money-check-dollar',
            'fas fa-magnifying-glass', 'fas fa-comments', 'fas fa-calendar-check', 'fas fa-circle-check',
            'fas fa-graduation-cap', 'fas fa-school', 'fas fa-book', 'fas fa-envelope', 'fas fa-phone',
            'fas fa-handshake', 'fas fa-award', 'fas fa-stamp', 'fas fa-laptop', 'fas fa-list-check',
            'fas fa-user-check', 'fas fa-file-circle-check', 'fas fa-bell', 'fas fa-flag',
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

        function stepHtml(uid, data) {
            data = data || {};
            return `
                <div class="step-item" data-uid="${uid}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;margin-bottom:16px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <strong class="step-label" style="font-size:.86rem;"></strong>
                        <button type="button" class="btn-reset" onclick="removeStep('${uid}')"><i class="fas fa-trash"></i> Remove</button>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Icon (Font Awesome class)</label>
                        <div style="display:flex;gap:8px;">
                            <input type="text" class="form-field step-icon" placeholder="e.g. fas fa-file-signature" value="${escapeHtml(data.icon)}" style="flex:1;">
                            <button type="button" class="btn-reset" onclick="openIconPicker(this.previousElementSibling)" style="width:44px;flex-shrink:0;"><i class="fas fa-icons"></i></button>
                        </div>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Step Title</label>
                        <input type="text" class="form-field step-heading" placeholder="e.g. Submit Application" value="${escapeHtml(data.heading)}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Step Description</label>
                        <textarea class="form-field step-subheading" rows="3" placeholder="Short description">${escapeHtml(data.subheading)}</textarea>
                    </div>
                </div>
            `;
        }

        function renumberSteps() {
            document.querySelectorAll('.step-item').forEach((el, idx) => {
                el.querySelector('.step-label').textContent = 'Step #' + (idx + 1);
            });
        }

        function addStep(data) {
            stepUid++;
            const uid = stepUid;
            document.getElementById('stepsContainer').insertAdjacentHTML('beforeend', stepHtml(uid, data));
            renumberSteps();
        }

        function removeStep(uid) {
            const el = document.querySelector(`.step-item[data-uid="${uid}"]`);
            if (el) el.remove();
            renumberSteps();
        }

        document.getElementById('admissionProcessForm').addEventListener('submit', function () {
            const payload = {
                badge: document.getElementById('badgeField').value.trim(),
                heading: document.getElementById('headingField').value.trim(),
                subheading: document.getElementById('subheadingField').value.trim(),
                cta_text: document.getElementById('ctaTextField').value.trim(),
                cta_link: document.getElementById('ctaLinkField').value.trim(),
                steps: [],
            };

            document.querySelectorAll('#stepsContainer .step-item').forEach((row) => {
                payload.steps.push({
                    icon: row.querySelector('.step-icon').value.trim(),
                    heading: row.querySelector('.step-heading').value.trim(),
                    subheading: row.querySelector('.step-subheading').value.trim(),
                });
            });

            document.getElementById('payloadField').value = JSON.stringify(payload);
        });

        // Initial state
        (function () {
            if ((initial.steps || []).length) {
                initial.steps.forEach(addStep);
            } else {
                for (let i = 0; i < 4; i++) addStep();
            }
        })();
    </script>

@endsection
