@extends('adminlayout.app')
@section('title', 'Placement')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Placement</h2>
                <p>Add placement statistics and recruiter logos. Changes apply to the "Placement" section on the home page.</p>
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

        <form id="placementForm" method="POST" action="{{ route('admin.placement.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payload" id="payloadField">
            <input type="hidden" name="design_type" id="designTypeField" value="{{ $initialState['design_type'] }}">

            <!-- Display style picker -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-table-cells-large"></i> Recruiter Logos Display Style</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div class="design-option" data-design="grid" onclick="selectDesign('grid')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:16px;cursor:pointer;text-align:center;">
                            <i class="fas fa-table-cells" style="font-size:1.6rem;color:var(--primary-600,#2563eb);margin-bottom:8px;display:block;"></i>
                            <strong style="display:block;font-size:.86rem;">Row Wise (Grid)</strong>
                        </div>
                        <div class="design-option" data-design="marquee" onclick="selectDesign('marquee')" style="flex:1;min-width:220px;border:2px solid var(--grey-200,#e5e7eb);border-radius:10px;padding:16px;cursor:pointer;text-align:center;">
                            <i class="fas fa-arrows-left-right" style="font-size:1.6rem;color:var(--primary-600,#2563eb);margin-bottom:8px;display:block;"></i>
                            <strong style="display:block;font-size:.86rem;">Marquee (Auto Scroll)</strong>
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
                        <input type="text" class="form-field" id="badgeField" placeholder="e.g. Our Success" value="{{ $initialState['badge'] }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field" id="headingField" placeholder="e.g. Placement Highlights" value="{{ $initialState['heading'] }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Subheading</label>
                        <textarea class="form-field" id="subheadingField" rows="3" placeholder="Short description shown under the heading">{{ $initialState['subheading'] }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-chart-simple"></i> Placement Stats</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section" style="display:flex;gap:16px;flex-wrap:wrap;">
                        <div style="flex:1;min-width:180px;">
                            <label class="field-label">Highest Package</label>
                            <input type="text" class="form-field" id="highestPackageField" placeholder="e.g. 12 LPA" value="{{ $initialState['highest_package'] }}">
                        </div>
                        <div style="flex:1;min-width:180px;">
                            <label class="field-label">Average Package</label>
                            <input type="text" class="form-field" id="averagePackageField" placeholder="e.g. 5.5 LPA" value="{{ $initialState['average_package'] }}">
                        </div>
                        <div style="flex:1;min-width:180px;">
                            <label class="field-label">Total Recruiters</label>
                            <input type="text" class="form-field" id="totalRecruitersField" placeholder="e.g. 150+" value="{{ $initialState['total_recruiters'] }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recruiter Logos -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head" style="display:flex;justify-content:space-between;align-items:center;">
                    <h3 class="panel-head-title"><i class="fas fa-building"></i> Recruiter Logos <span style="font-weight:400;color:var(--grey-500,#6b7280);font-size:.8rem;">(shown 7 per row)</span></h3>
                    <button type="button" class="btn-reset" onclick="addLogo()"><i class="fas fa-plus"></i> Add Logo</button>
                </div>
                <div class="panel-body" id="logosContainer" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:16px;"></div>
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
        let logoUid = 0;

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
        }

        function logoHtml(uid, data) {
            data = data || {};
            const imageSrc = data.image || '';
            return `
                <div class="logo-item" data-uid="${uid}" style="border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:12px;text-align:center;">
                    <button type="button" class="btn-reset" onclick="removeLogo('${uid}')" style="float:right;"><i class="fas fa-trash"></i></button>
                    <div style="clear:both;"></div>
                    <input type="file" class="form-field logo-image-input" accept="image/*" onchange="previewImage(this, 'logoImgPreview-${uid}')" style="margin-bottom:8px;">
                    <input type="hidden" class="logo-image-existing" value="${escapeHtml(data.existing_image)}">
                    <img id="logoImgPreview-${uid}" src="${imageSrc}" style="display:${imageSrc ? '' : 'none'};max-height:60px;max-width:100%;margin-bottom:8px;">
                    <input type="text" class="form-field logo-company-name" placeholder="Company name" value="${escapeHtml(data.company_name)}" style="margin-bottom:8px;">
                    <input type="text" class="form-field logo-link" placeholder="https://example.com (optional)" value="${escapeHtml(data.link)}">
                </div>
            `;
        }

        function addLogo(data) {
            logoUid++;
            const uid = logoUid;
            document.getElementById('logosContainer').insertAdjacentHTML('beforeend', logoHtml(uid, data));
        }

        function removeLogo(uid) {
            const el = document.querySelector(`.logo-item[data-uid="${uid}"]`);
            if (el) el.remove();
        }

        document.getElementById('placementForm').addEventListener('submit', function () {
            const payload = {
                badge: document.getElementById('badgeField').value.trim(),
                heading: document.getElementById('headingField').value.trim(),
                subheading: document.getElementById('subheadingField').value.trim(),
                highest_package: document.getElementById('highestPackageField').value.trim(),
                average_package: document.getElementById('averagePackageField').value.trim(),
                total_recruiters: document.getElementById('totalRecruitersField').value.trim(),
                design_type: document.getElementById('designTypeField').value,
                logos: [],
            };

            document.querySelectorAll('#logosContainer .logo-item').forEach((row, idx) => {
                payload.logos.push({
                    company_name: row.querySelector('.logo-company-name').value.trim(),
                    link: row.querySelector('.logo-link').value.trim(),
                    existing_image: row.querySelector('.logo-image-existing').value || null,
                });

                const imageInput = row.querySelector('.logo-image-input');
                imageInput.name = `logos[${idx}][image]`;
            });

            document.getElementById('payloadField').value = JSON.stringify(payload);
        });

        // Initial state
        (function () {
            if ((initial.logos || []).length) {
                initial.logos.forEach(addLogo);
            } else {
                for (let i = 0; i < 7; i++) addLogo();
            }

            selectDesign(initial.design_type || 'grid');
        })();
    </script>

@endsection
