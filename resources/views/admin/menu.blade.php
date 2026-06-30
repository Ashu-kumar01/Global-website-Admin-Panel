@extends('adminlayout.app')
@section('title', 'Menu Setup')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Menu Setup</h2>
                <p>Build the site navigation — mega menus, split menus, single links, special buttons and logo
                    position.</p>
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

        @php($logoUrl = $user && $user->logo ? asset($user->logo) : asset('logo.png'))

        <form id="menuForm" method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="payload" id="payloadField">

            <!-- Logo -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-image"></i> Logo</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:24px;flex-wrap:wrap;align-items:flex-start;margin-bottom:18px;">
                        <div>
                            <label class="field-label">Logo Preview</label>
                            <div style="display:flex;align-items:center;justify-content:center;border:1px solid var(--grey-200);border-radius:8px;padding:10px;min-width:120px;min-height:60px;">
                                <img id="logoPreviewImg" src="{{ $logoUrl }}" alt="logo preview" style="height:{{ $initialState['logoSize'] ?? 40 }}px;width:auto;object-fit:contain;">
                            </div>
                        </div>
                        <div style="flex:1;min-width:220px;">
                            <label class="field-label">Upload Logo</label>
                            <input type="file" name="logo" id="logoInput" accept="image/*" class="form-field" onchange="previewLogo(this)">
                            <p style="font-size:.76rem;color:var(--grey-500,#6b7280);margin-top:4px;">JPG, PNG, WEBP or SVG. Max 5MB.</p>
                        </div>
                        <div style="min-width:220px;">
                            <label class="field-label">Logo Size: <span id="logoSizeValue">{{ $initialState['logoSize'] ?? 40 }}</span>px</label>
                            <input type="range" name="logo_size" id="logoSize" min="16" max="200" value="{{ $initialState['logoSize'] ?? 40 }}" class="form-field" oninput="updateLogoSize(this.value)">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Logo position -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-arrows-left-right"></i> Logo Position</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:18px;">
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="logoPositionRadio" value="left" id="logoLeft"> Left
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="logoPositionRadio" value="center" id="logoCenter"> Center
                        </label>
                        <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                            <input type="radio" name="logoPositionRadio" value="right" id="logoRight"> Right
                        </label>
                    </div>
                </div>
            </div>

            <!-- Menus -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-bars"></i> Menus</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Number of Menus</label>
                        <input type="number" min="0" max="6" id="menuCount" class="form-field" style="max-width:160px;" value="0">
                    </div>
                    <div id="menusContainer"></div>
                </div>
            </div>

            <!-- Special buttons -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-square-plus"></i> Special Buttons</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Number of Buttons</label>
                        <input type="number" min="0" max="10" id="buttonCount" class="form-field" style="max-width:160px;" value="0">
                    </div>
                    <div id="buttonsContainer"></div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <span class="btn-label"><i class="fas fa-floppy-disk"></i> Save Menu</span>
                    <span class="spinner"></span>
                </button>
                <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            </div>

        </form>
    </div>

    <script>
        const state = @json($initialState);
        let logoUrl = @json($logoUrl);

        function previewLogo(input) {
            const file = input.files && input.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (e) {
                logoUrl = e.target.result;
                document.getElementById('logoPreviewImg').src = logoUrl;
            };
            reader.readAsDataURL(file);
        }

        function updateLogoSize(value) {
            state.logoSize = parseInt(value) || 40;
            document.getElementById('logoSizeValue').textContent = state.logoSize;
            document.getElementById('logoPreviewImg').style.height = state.logoSize + 'px';
        }

        function menuItemTemplate() {
            return { label: '', link: '', is_external: false, submenu: [] };
        }

        function resizeArray(arr, size, templateFn) {
            arr = arr.slice(0, size);
            while (arr.length < size) arr.push(templateFn());
            return arr;
        }

        function renderMenus() {
            const container = document.getElementById('menusContainer');
            container.innerHTML = state.menus.map((menu, mIdx) => `
                <div class="form-section" style="border:1px solid var(--grey-200);border-radius:8px;padding:16px;margin-top:14px;">
                    <div style="display:flex;gap:14px;flex-wrap:wrap;align-items:flex-end;margin-bottom:12px;">
                        <div style="flex:1;min-width:200px;">
                            <label class="field-label">Menu Name</label>
                            <input type="text" class="form-field" value="${escapeHtml(menu.name)}"
                                oninput="state.menus[${mIdx}].name = this.value">
                        </div>
                        <div style="min-width:180px;">
                            <label class="field-label">Menu Type</label>
                            <select class="form-field" onchange="state.menus[${mIdx}].type = this.value; renderMenus()">
                                <option value="single" ${menu.type === 'single' ? 'selected' : ''}>Single Menu</option>
                                <option value="mega" ${menu.type === 'mega' ? 'selected' : ''}>Mega Menu</option>
                                <option value="split" ${menu.type === 'split' ? 'selected' : ''}>Split Menu</option>
                            </select>
                        </div>
                        <div style="min-width:140px;">
                            <label class="field-label">Number of Rows</label>
                            <input type="number" min="0" max="20" class="form-field" value="${menu.items.length}"
                                onchange="resizeMenuItems(${mIdx}, this.value)">
                        </div>
                        <button type="button" class="btn-reset" style="height:40px;" onclick="removeMenu(${mIdx})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div>${renderMenuItems(menu, mIdx)}</div>
                </div>
            `).join('');
        }

        function renderMenuItems(menu, mIdx) {
            if (menu.type === 'split') {
                return menu.items.map((item, iIdx) => `
                    <div style="display:flex;gap:14px;flex-wrap:wrap;border-top:1px dashed var(--grey-200);padding-top:10px;margin-top:10px;">
                        <div style="flex:1;min-width:180px;">
                            <label class="field-label">Category Name</label>
                            <input type="text" class="form-field" value="${escapeHtml(item.label)}"
                                oninput="state.menus[${mIdx}].items[${iIdx}].label = this.value">
                        </div>
                        <div style="min-width:140px;">
                            <label class="field-label">Submenu Rows</label>
                            <input type="number" min="0" max="20" class="form-field" value="${item.submenu.length}"
                                onchange="resizeSubmenu(${mIdx}, ${iIdx}, this.value)">
                        </div>
                        <div style="width:100%;padding-left:20px;">
                            ${item.submenu.map((sub, sIdx) => `
                                <div style="display:flex;gap:10px;margin-top:8px;align-items:center;">
                                    <input type="text" class="form-field" placeholder="Submenu label" value="${escapeHtml(sub.label)}"
                                        oninput="state.menus[${mIdx}].items[${iIdx}].submenu[${sIdx}].label = this.value">
                                    <input type="text" class="form-field" placeholder="${sub.is_external ? 'https://example.com' : 'Submenu link'}" value="${escapeHtml(sub.link || '')}"
                                        oninput="state.menus[${mIdx}].items[${iIdx}].submenu[${sIdx}].link = this.value">
                                    <label style="display:flex;align-items:center;gap:5px;font-size:.78rem;white-space:nowrap;cursor:pointer;">
                                        <input type="checkbox" ${sub.is_external ? 'checked' : ''}
                                            onchange="state.menus[${mIdx}].items[${iIdx}].submenu[${sIdx}].is_external = this.checked; renderMenus()">
                                        External
                                    </label>
                                </div>
                            `).join('')}
                        </div>
                    </div>
                `).join('');
            }

            return menu.items.map((item, iIdx) => `
                <div style="display:flex;gap:10px;margin-top:10px;align-items:center;">
                    <input type="text" class="form-field" placeholder="Label" value="${escapeHtml(item.label)}"
                        oninput="state.menus[${mIdx}].items[${iIdx}].label = this.value">
                    <input type="text" class="form-field" placeholder="${item.is_external ? 'https://example.com' : 'Link'}" value="${escapeHtml(item.link || '')}"
                        oninput="state.menus[${mIdx}].items[${iIdx}].link = this.value">
                    <label style="display:flex;align-items:center;gap:5px;font-size:.78rem;white-space:nowrap;cursor:pointer;">
                        <input type="checkbox" ${item.is_external ? 'checked' : ''}
                            onchange="state.menus[${mIdx}].items[${iIdx}].is_external = this.checked; renderMenus()">
                        External
                    </label>
                </div>
            `).join('');
        }

        function resizeMenuItems(mIdx, count) {
            state.menus[mIdx].items = resizeArray(state.menus[mIdx].items, parseInt(count) || 0, menuItemTemplate);
            renderMenus();
        }

        function resizeSubmenu(mIdx, iIdx, count) {
            state.menus[mIdx].items[iIdx].submenu = resizeArray(
                state.menus[mIdx].items[iIdx].submenu, parseInt(count) || 0, () => ({ label: '', link: '' })
            );
            renderMenus();
        }

        function removeMenu(mIdx) {
            state.menus.splice(mIdx, 1);
            document.getElementById('menuCount').value = state.menus.length;
            renderMenus();
        }

        function renderButtons() {
            const container = document.getElementById('buttonsContainer');
            container.innerHTML = state.buttons.map((btn, bIdx) => `
                <div style="display:flex;gap:10px;margin-top:10px;align-items:center;">
                    <input type="text" class="form-field" placeholder="Button name" value="${escapeHtml(btn.label)}"
                        oninput="state.buttons[${bIdx}].label = this.value">
                    <input type="text" class="form-field" placeholder="${btn.is_external ? 'https://example.com' : 'Button link'}" value="${escapeHtml(btn.link || '')}"
                        oninput="state.buttons[${bIdx}].link = this.value">
                    <label style="display:flex;align-items:center;gap:5px;font-size:.78rem;white-space:nowrap;cursor:pointer;">
                        <input type="checkbox" ${btn.is_external ? 'checked' : ''}
                            onchange="state.buttons[${bIdx}].is_external = this.checked; renderButtons()">
                        External
                    </label>
                </div>
            `).join('');
        }

        function escapeHtml(str) {
            return (str || '').replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
        }

        document.getElementById('menuCount').addEventListener('change', function () {
            state.menus = resizeArray(state.menus, parseInt(this.value) || 0, () => ({ name: '', type: 'single', items: [] }));
            renderMenus();
        });

        document.getElementById('buttonCount').addEventListener('change', function () {
            state.buttons = resizeArray(state.buttons, parseInt(this.value) || 0, () => ({ label: '', link: '', is_external: false }));
            renderButtons();
        });

        document.getElementById('menuForm').addEventListener('submit', function () {
            const radio = document.querySelector('input[name="logoPositionRadio"]:checked');
            state.logoPosition = radio ? radio.value : 'left';
            document.getElementById('payloadField').value = JSON.stringify({
                menus: state.menus,
                buttons: state.buttons,
                logo_position: state.logoPosition,
                logo_size: state.logoSize,
            });
        });

        // Initial render from existing saved state
        document.getElementById('menuCount').value = state.menus.length;
        document.getElementById('buttonCount').value = state.buttons.length;
        const initialLogo = state.logoPosition || 'left';
        document.getElementById(initialLogo === 'left' ? 'logoLeft' : (initialLogo === 'right' ? 'logoRight' : 'logoCenter')).checked = true;
        state.logoSize = state.logoSize || 40;
        document.getElementById('logoSize').value = state.logoSize;
        document.getElementById('logoSizeValue').textContent = state.logoSize;
        renderMenus();
        renderButtons();
    </script>

@endsection
