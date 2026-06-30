@extends('adminlayout.app')
@section('title', 'Home Page Builder')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Home Page Builder</h2>
                <p>Select, order and configure the sections that make up your home page.</p>
            </div>
        </div>

        <!-- Progress -->
        <div class="panel" style="margin-bottom:20px;">
            <div class="panel-body" style="padding:18px 22px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                    <strong id="stepLabel" style="font-size:.86rem;"></strong>
                    <span id="autosaveStatus" style="font-size:.76rem;color:var(--grey-500,#6b7280);"></span>
                </div>
                <div style="background:var(--grey-200,#e5e7eb);border-radius:999px;height:8px;overflow:hidden;">
                    <div id="progressBar" style="background:#2563eb;height:100%;width:0%;transition:width .3s ease;"></div>
                </div>
            </div>
        </div>

        <div id="builderError" style="display:none;background:#fef2f2;color:var(--red-600,#dc2626);padding:12px 16px;border-radius:8px;margin-bottom:18px;font-size:.86rem;"></div>
        <div id="builderSuccess" style="display:none;background:var(--green-50,#f0fdf4);color:var(--green-600,#16a34a);padding:12px 16px;border-radius:8px;margin-bottom:18px;font-size:.86rem;"></div>

        <div style="display:flex;gap:24px;align-items:flex-start;flex-wrap:wrap;">
            <!-- Step content -->
            <div style="flex:2;min-width:340px;">
                <div class="panel" style="margin-bottom:24px;">
                    <div class="panel-body" id="stepContent"></div>
                </div>

                <div class="form-footer" style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button type="button" class="btn-reset" id="btnPrevious" onclick="goPrevious()">
                        <i class="fas fa-arrow-left"></i> Previous
                    </button>
                    <button type="button" class="btn-reset" id="btnSkip" onclick="skipSection()" style="display:none;">
                        Skip Section
                    </button>
                    <button type="button" class="btn-reset" onclick="saveDraft()">
                        <i class="fas fa-floppy-disk"></i> Save Draft
                    </button>
                    <button type="button" class="btn-save" id="btnContinue" onclick="goNext()" style="margin-left:auto;">
                        <span class="btn-label">Save &amp; Continue <i class="fas fa-arrow-right"></i></span>
                    </button>
                    <button type="button" class="btn-save" id="btnPublish" onclick="publishHomePage()" style="display:none;background:#16a34a;">
                        <span class="btn-label"><i class="fas fa-rocket"></i> Publish Home Page</span>
                    </button>
                </div>
            </div>

            <!-- Live preview -->
            <div style="flex:1;min-width:280px;position:sticky;top:20px;">
                <div class="panel">
                    <div class="panel-head">
                        <h3 class="panel-head-title"><i class="fas fa-eye"></i> Live Preview</h3>
                    </div>
                    <div class="panel-body" id="previewPane"></div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .hb-catalog-item { display:flex; gap:12px; align-items:flex-start; border:1px solid var(--grey-200,#e5e7eb); border-radius:8px; padding:12px 14px; cursor:pointer; }
        .hb-catalog-item.disabled { opacity:.45; cursor:not-allowed; }
        .hb-catalog-icon { width:36px; height:36px; border-radius:8px; background:#eff6ff; color:#2563eb; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
        .hb-priority-row { display:flex; align-items:center; gap:10px; border:1px solid var(--grey-200,#e5e7eb); border-radius:8px; padding:10px 14px; margin-bottom:8px; background:#fff; cursor:grab; }
        .hb-priority-row.dragging { opacity:.4; }
        .hb-badge { display:inline-block; padding:3px 10px; border-radius:999px; font-size:.72rem; font-weight:600; }
        .hb-badge-ok { background:#f0fdf4; color:#16a34a; }
        .hb-badge-pending { background:#fffbeb; color:#d97706; }
        .hb-review-row { display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--grey-200,#e5e7eb); padding:12px 0; }
    </style>

    <script>
        const initial = @json($initialState);
        const routes = {
            selection: '{{ route('admin.home-builder.selection') }}',
            configure: (key) => `{{ url('admin/home-builder/sections') }}/${key}/configure`,
            draft: '{{ route('admin.home-builder.draft') }}',
            publish: '{{ route('admin.home-builder.publish') }}',
        };
        
        const csrfToken = '{{ csrf_token() }}';

        let state = initial;
        let currentStepIndex = 0;
        let selection = state.sections.map(s => ({ key: s.key, priority: s.priority }));
        let dragSrcIndex = null;
        let autosaveTimer = null;

        function escapeHtml(str) {
            return (str ?? '').toString().replace(/[&<>"']/g, c => ({
                '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
            }[c]));
        }

        function setAutosaveStatus(text) {
            document.getElementById('autosaveStatus').textContent = text;
        }

        function showError(message) {
            const el = document.getElementById('builderError');
            el.textContent = message;
            el.style.display = message ? '' : 'none';
            document.getElementById('builderSuccess').style.display = 'none';
        }

        function showSuccess(message) {
            const el = document.getElementById('builderSuccess');
            el.textContent = message;
            el.style.display = message ? '' : 'none';
            document.getElementById('builderError').style.display = 'none';
        }

        async function apiPost(url, body) {
            const res = await fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                body: JSON.stringify(body || {}),
            });
            const data = await res.json();
            if (!res.ok) {
                throw new Error(data.message || 'Something went wrong.');
            }
            return data;
        }

        function orderedSelection() {
            return [...selection].sort((a, b) => a.priority - b.priority);
        }

        function sectionDef(key) {
            return state.catalog.find(c => c.key === key);
        }

        function sectionRow(key) {
            return state.sections.find(s => s.key === key);
        }

        function totalSteps() {
            return 1 + selection.length + 1; // select + per-section configure + review
        }

        function stepKeyAt(index) {
            if (index === 0) return 'select';
            if (index === totalSteps() - 1) return 'review';
            return 'configure:' + orderedSelection()[index - 1].key;
        }

        function renderProgress() {
            const total = totalSteps();
            const pct = Math.round(((currentStepIndex + 1) / total) * 100);
            document.getElementById('progressBar').style.width = pct + '%';
            const stepKey = stepKeyAt(currentStepIndex);
            let label = `Step ${currentStepIndex + 1} of ${total} — `;
            if (stepKey === 'select') label += 'Select Sections';
            else if (stepKey === 'review') label += 'Final Review';
            else label += sectionDef(stepKey.split(':')[1])?.label || '';
            document.getElementById('stepLabel').textContent = label + ` (${pct}%)`;
        }

        // ---------- Step 1: Select & Priority ----------

        function renderSelectStep() {
            const count = selection.length;
            const atMax = count >= state.max_sections;

            const catalogHtml = state.catalog.map(def => {
                const checked = selection.some(s => s.key === def.key);
                const disabled = atMax && !checked;
                return `
                    <label class="hb-catalog-item ${disabled ? 'disabled' : ''}">
                        <input type="checkbox" class="hb-checkbox" value="${def.key}" ${checked ? 'checked' : ''} ${disabled ? 'disabled' : ''} onchange="onSectionToggle(this)">
                        <span class="hb-catalog-icon"><i class="fas ${def.icon}"></i></span>
                        <span>
                            <strong style="display:block;font-size:.86rem;">${escapeHtml(def.label)}</strong>
                            <span style="font-size:.76rem;color:var(--grey-500,#6b7280);">${escapeHtml(def.description)}</span>
                        </span>
                    </label>
                `;
            }).join('');

            const priorityHtml = orderedSelection().map((s, idx) => {
                const def = sectionDef(s.key);
                return `
                    <div class="hb-priority-row" draggable="true" data-key="${s.key}"
                         ondragstart="onDragStart(event, ${idx})" ondragover="event.preventDefault()" ondrop="onDrop(event, ${idx})">
                        <i class="fas fa-grip-vertical" style="color:var(--grey-400,#9ca3af);"></i>
                        <span style="width:28px;height:28px;border-radius:6px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700;">${idx + 1}</span>
                        <strong style="font-size:.86rem;flex:1;">${escapeHtml(def?.label || s.key)}</strong>
                    </div>
                `;
            }).join('') || '<p style="font-size:.82rem;color:var(--grey-500,#6b7280);">Select sections above to set their order.</p>';

            document.getElementById('stepContent').innerHTML = `
                <h3 class="panel-head-title" style="margin-top:0;margin-bottom:0.3rem"><i class="fas fa-list-check"></i> Choose Home Page Sections</h3>
                <p style="font-size:.82rem;color:var(--grey-500,#6b7280);margin-bottom:0.7rem">Selected: <strong>${count} / ${state.max_sections}</strong></p>
                ${atMax ? `<p style="font-size:.8rem;color:#d97706;background:#fffbeb;padding:8px 12px;border-radius:6px;">Maximum ${state.max_sections} sections are allowed.</p>` : ''}
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:12px;margin-bottom:24px;">
                    ${catalogHtml}
                </div>

                <h3 class="panel-head-title" style="margin-bottom:0.5rem"><i class="fas fa-arrow-down-up-across-line"></i> Section Priority</h3>
                <p style="font-size:.78rem;color:var(--grey-500,#6b7280);margin-bottom:0.5rem">Drag rows to reorder. Priority updates automatically.</p>
                <div id="priorityList">${priorityHtml}</div>
            `;
        }

        function onSectionToggle(checkbox) {
            const key = checkbox.value;
            if (checkbox.checked) {
                if (selection.length >= state.max_sections) {
                    checkbox.checked = false;
                    return;
                }
                selection.push({ key, priority: selection.length + 1 });
            } else {
                selection = selection.filter(s => s.key !== key);
                selection.forEach((s, idx) => s.priority = idx + 1);
            }
            renderSelectStep();
            queueAutosaveSelection();
        }

        function onDragStart(e, idx) {
            dragSrcIndex = idx;
            e.target.classList.add('dragging');
        }

        function onDrop(e, targetIdx) {
            e.preventDefault();
            const ordered = orderedSelection();
            const [moved] = ordered.splice(dragSrcIndex, 1);
            ordered.splice(targetIdx, 0, moved);
            ordered.forEach((s, idx) => s.priority = idx + 1);
            selection = ordered;
            renderSelectStep();
            queueAutosaveSelection();
        }

        function queueAutosaveSelection() {
            setAutosaveStatus('Saving…');
            clearTimeout(autosaveTimer);
            autosaveTimer = setTimeout(() => persistSelection().catch(err => showError(err.message)), 600);
        }

        async function persistSelection() {
            if (selection.length === 0) {
                setAutosaveStatus('');
                return;
            }
            const data = await apiPost(routes.selection, { sections: selection });
            state = data;
            setAutosaveStatus('Saved ' + new Date().toLocaleTimeString());
            renderPreview();
        }

        // ---------- Step 2..N-1: Configure ----------

        function renderConfigureStep(key) {
            const def = sectionDef(key);
            const row = sectionRow(key);
            const isReal = def.type === 'real';
            const configured = row?.is_configured;

            document.getElementById('stepContent').innerHTML = `
                <h3 class="panel-head-title" style="margin-top:0;"><i class="fas ${def.icon}"></i> ${escapeHtml(def.label)}</h3>
                <p style="font-size:.84rem;color:var(--grey-500,#6b7280);">${escapeHtml(def.description)}</p>
                <p>
                    <span class="hb-badge ${configured ? 'hb-badge-ok' : 'hb-badge-pending'}">
                        <i class="fas ${configured ? 'fa-circle-check' : 'fa-triangle-exclamation'}"></i>
                        ${configured ? 'Configured' : 'Not Configured Yet'}
                    </span>
                </p>
                ${isReal ? `
                    <p style="font-size:.84rem;margin-bottom:1rem">${row?.preview_text ? 'Current content: <strong>' + escapeHtml(row.preview_text) + '</strong>' : 'No content saved yet for this section.'}</p>
                    <a href="${row?.admin_route || '#'}" target="_blank" class="btn-save" style="display:inline-flex;text-decoration:none;">
                        <span class="btn-label"><i class="fas fa-pen-to-square"></i> Open Full Editor</span>
                    </a>
                    <button type="button" class="btn-reset" onclick="refreshConfigureStatus('${key}')" style="margin-left:8px;">
                        <i class="fas fa-rotate"></i> Refresh Status
                    </button>
                ` : `
                    <p style="font-size:.84rem;">${row?.preview_text ? 'Current content: <strong>' + escapeHtml(row.preview_text) + '</strong>' : 'No content saved yet for this section.'}</p>
                    <a href="${row?.admin_route || '#'}" target="_blank" class="btn-save" style="display:inline-flex;text-decoration:none;">
                        <span class="btn-label"><i class="fas fa-pen-to-square"></i> Open Full Editor</span>
                    </a>
                    <button type="button" class="btn-reset" onclick="refreshConfigureStatus('${key}')" style="margin-left:8px;">
                        <i class="fas fa-rotate"></i> Refresh Status
                    </button>

                    <p style="font-size:.82rem;color:var(--grey-500,#6b7280);background:#f9fafb;padding:10px 14px;border-radius:8px;">
                        <i class="fas fa-circle-info"></i> A dedicated configuration screen for this section is coming soon.
                    </p>
                    <div class="form-section">
                        <label class="field-label">Notes (optional)</label>
                        <textarea class="form-field" id="placeholderNote-${key}" rows="2" oninput="queuePlaceholderAutosave('${key}')">${escapeHtml(row?.note || '')}</textarea>
                    </div>
                    <label style="display:flex;align-items:center;gap:8px;font-size:.86rem;cursor:pointer;">
                        <input type="checkbox" id="placeholderConfigured-${key}" ${configured ? 'checked' : ''} onchange="togglePlaceholderConfigured('${key}', this.checked)">
                        Mark as configured for now
                    </label>
                `}
            `;
        }

        async function refreshConfigureStatus(key) {
            setAutosaveStatus('Checking…');
            const data = await apiPost(routes.draft, {});
            state = data;
            setAutosaveStatus('Updated ' + new Date().toLocaleTimeString());
            renderStep();
        }

        let placeholderNoteTimer = null;
        function queuePlaceholderAutosave(key) {
            clearTimeout(placeholderNoteTimer);
            setAutosaveStatus('Saving…');
            placeholderNoteTimer = setTimeout(async () => {
                const note = document.getElementById(`placeholderNote-${key}`).value;
                const data = await apiPost(routes.configure(key), { note });
                state = data;
                setAutosaveStatus('Saved ' + new Date().toLocaleTimeString());
                renderPreview();
            }, 600);
        }

        async function togglePlaceholderConfigured(key, isConfigured) {
            setAutosaveStatus('Saving…');
            const note = document.getElementById(`placeholderNote-${key}`)?.value || '';
            const data = await apiPost(routes.configure(key), { is_configured: isConfigured, note });
            state = data;
            setAutosaveStatus('Saved ' + new Date().toLocaleTimeString());
            renderStep();
        }

        function skipSection() {
            goNext(true);
        }

        // ---------- Final step: Review ----------

        function renderReviewStep() {
            const rowsHtml = orderedSelection().map(s => {
                const def = sectionDef(s.key);
                const row = sectionRow(s.key);
                const configured = row?.is_configured;
                return `
                    <div class="hb-review-row">
                        <div>
                            <strong style="font-size:.88rem;"><i class="fas ${def.icon}"></i> ${escapeHtml(def.label)}</strong>
                            <div style="font-size:.76rem;color:var(--grey-500,#6b7280);">Priority ${s.priority}</div>
                        </div>
                        <span class="hb-badge ${configured ? 'hb-badge-ok' : 'hb-badge-pending'}">${configured ? 'Configured' : 'Not Configured'}</span>
                    </div>
                `;
            }).join('');

            document.getElementById('stepContent').innerHTML = `
                <h3 class="panel-head-title" style="margin-top:0;"><i class="fas fa-clipboard-check"></i> Final Review</h3>
                <p style="font-size:.82rem;color:var(--grey-500,#6b7280);">Review your selected sections before publishing.</p>
                ${rowsHtml}
            `;
        }

        // ---------- Preview pane ----------

        function renderPreview() {
            const stepKey = stepKeyAt(currentStepIndex);
            const pane = document.getElementById('previewPane');

            if (stepKey === 'select' || stepKey === 'review') {
                pane.innerHTML = orderedSelection().map(s => {
                    const def = sectionDef(s.key);
                    return `<div style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--grey-200,#e5e7eb);">
                        <!--<span style="width:26px;height:26px;border-radius:6px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;font-size:.74rem;font-weight:700;">${s.priority}</span>-->
                        <span style="font-size:.84rem;"><i class="fas ${def.icon}"></i> ${escapeHtml(def.label)}</span>
                    </div>`;
                }).join('') || '<p style="font-size:.82rem;color:var(--grey-500,#6b7280);">No sections selected yet.</p>';
                return;
            }

            const key = stepKey.split(':')[1];
            const def = sectionDef(key);
            const row = sectionRow(key);
            pane.innerHTML = `
                <div style="text-align:center;padding:20px 10px;">
                    <div style="width:56px;height:56px;border-radius:14px;background:#eff6ff;color:#2563eb;display:flex;align-items:center;justify-content:center;margin:0 auto 14px;font-size:1.5rem;">
                        <i class="fas ${def.icon}"></i>
                    </div>
                    <h4 style="margin:0 0 6px;font-size:1rem;">${escapeHtml(def.label)}</h4>
                    ${row?.preview_text ? `<p style="font-size:.84rem;color:#374151;">${escapeHtml(row.preview_text)}</p>` : `<p style="font-size:.8rem;color:var(--grey-500,#6b7280);">${escapeHtml(def.description)}</p>`}
                </div>
            `;
        }

        // ---------- Navigation ----------

        function renderStep() {
            const stepKey = stepKeyAt(currentStepIndex);
            document.getElementById('btnPrevious').style.display = currentStepIndex === 0 ? 'none' : '';
            document.getElementById('btnSkip').style.display = stepKey.startsWith('configure:') ? '' : 'none';
            document.getElementById('btnContinue').style.display = stepKey === 'review' ? 'none' : '';
            document.getElementById('btnPublish').style.display = stepKey === 'review' ? '' : 'none';

            if (stepKey === 'select') renderSelectStep();
            else if (stepKey === 'review') renderReviewStep();
            else renderConfigureStep(stepKey.split(':')[1]);

            renderProgress();
            renderPreview();
            showError('');
            showSuccess('');
        }

        async function goNext(skip) {
            const stepKey = stepKeyAt(currentStepIndex);
            try {
                if (stepKey === 'select') {
                    if (selection.length === 0) {
                        showError('Select at least one section to continue.');
                        return;
                    }
                    await persistSelection();
                }
                if (currentStepIndex < totalSteps() - 1) {
                    currentStepIndex++;
                    renderStep();
                }
            } catch (err) {
                showError(err.message);
            }
        }

        function goPrevious() {
            if (currentStepIndex > 0) {
                currentStepIndex--;
                renderStep();
            }
        }

        async function saveDraft() {
            try {
                setAutosaveStatus('Saving draft…');
                const data = await apiPost(routes.draft, {});
                state = data;
                showSuccess('Draft saved.');
                setAutosaveStatus('Saved ' + new Date().toLocaleTimeString());
            } catch (err) {
                showError(err.message);
            }
        }

        async function publishHomePage() {
            try {
                const data = await apiPost(routes.publish, {});
                state = data;
                showSuccess('Home page published successfully.');
            } catch (err) {
                showError(err.message);
            }
        }

        renderStep();
    </script>

@endsection
