@extends('adminlayout.app')
@section('title', 'About Section')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>About Section</h2>
                <p>Configure the badge, heading, text, read more button and images for the About section.</p>
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

        <form id="aboutForm" method="POST" action="{{ route('admin.about-section.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Content -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-pen-to-square"></i> Content</h3>
                </div>
                <div class="panel-body">
                    <div class="form-section">
                        <label class="field-label">Badge</label>
                        <input type="text" class="form-field" name="badge" id="aboutBadge" placeholder="e.g. ABOUT US"
                            value="{{ old('badge', $aboutSection->badge ?? '') }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Heading</label>
                        <input type="text" class="form-field" name="heading" id="aboutHeading"
                            placeholder="e.g. Who We Are" value="{{ old('heading', $aboutSection->heading ?? '') }}">
                    </div>
                    <div class="form-section">
                        <label class="field-label">Text</label>
                        <textarea class="form-field" id="aboutText" name="subheading" rows="4"
                            placeholder="Short description about your institution">{{ old('subheading', $aboutSection->subheading ?? '') }}</textarea>
                    </div>

                    <div class="form-section">
                        <label class="field-label">Content Position</label>
                        <div style="display:flex;gap:18px;">
                            <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                <input type="radio" name="aboutPosition" value="left" id="aboutPositionLeft"
                                    {{ old('aboutPosition', $aboutSection->aboutPosition ?? 'left') === 'left' ? 'checked' : '' }}>
                                Left
                            </label>
                            <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                <input type="radio" name="aboutPosition" value="center" id="aboutPositionCenter"
                                    {{ old('aboutPosition', $aboutSection->aboutPosition ?? '') === 'center' ? 'checked' : '' }}>
                                Center
                            </label>
                            <label style="display:flex;align-items:center;gap:6px;font-size:.86rem;cursor:pointer;">
                                <input type="radio" name="aboutPosition" value="right" id="aboutPositionRight"
                                    {{ old('aboutPosition', $aboutSection->aboutPosition ?? '') === 'right' ? 'checked' : '' }}>
                                Right
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Read More button -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-square-plus"></i> Read More Button</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:18px;flex-wrap:wrap;">
                        <div class="form-section" style="flex:1;min-width:220px;">
                            <label class="field-label">Button Label</label>
                            <input type="text" class="form-field" name="button_label" id="aboutBtnLabel"
                                placeholder="e.g. Read More" value="{{ old('button_label', $aboutSection->button_label ?? '') }}">
                        </div>
                        <div class="form-section" style="flex:1;min-width:220px;">
                            <label class="field-label">Button Link</label>
                            <input type="text" class="form-field" id="aboutBtnLink" name="aboutBtnLink"
                                placeholder="https://example.com/about" value="{{ old('aboutBtnLink', $aboutSection->aboutBtnLink ?? '') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="panel" style="margin-bottom:24px;">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-images"></i> Images <span
                            style="font-size:.75rem;color:var(--grey-500,#6b7280);font-weight:400;">(max 2)</span></h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:24px;flex-wrap:wrap;">

                        <!-- Image 1 -->
                        <div
                            style="flex:1;min-width:260px;border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;">
                            <strong style="font-size:.86rem;display:block;margin-bottom:10px;">Image 1</strong>
                            <div class="form-section">
                                <label class="field-label">Upload Image</label>
                                <input type="file" class="form-field about-image-input" id="aboutImage1"
                                    name="image1" accept="image/*"
                                    onchange="previewAboutImage(this, 'aboutImage1Preview')">
                                @php($image1Url = !empty($aboutSection?->image1) ? \Illuminate\Support\Facades\Storage::url($aboutSection->image1) : '')
                                <img id="aboutImage1Preview" src="{{ $image1Url }}" alt=""
                                    style="display:{{ $image1Url ? '' : 'none' }};margin-top:8px;max-height:120px;border-radius:6px;border:1px solid var(--grey-200);">
                            </div>
                            <div class="form-section">
                                <label class="field-label">Image Position</label>
                                <select class="form-field" id="aboutImage1Position" name="aboutImage1Position">
                                    @foreach (['left' => 'Left', 'right' => 'Right', 'top' => 'Top', 'bottom' => 'Bottom'] as $value => $label)
                                        <option value="{{ $value }}" {{ old('aboutImage1Position', $aboutSection->aboutImage1Position ?? 'left') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Image 2 -->
                        <div
                            style="flex:1;min-width:260px;border:1px solid var(--grey-200,#e5e7eb);border-radius:8px;padding:16px;">
                            <strong style="font-size:.86rem;display:block;margin-bottom:10px;">Image 2</strong>
                            <div class="form-section">
                                <label class="field-label">Upload Image</label>
                                <input type="file" class="form-field about-image-input" name="image2"
                                    id="aboutImage2" accept="image/*"
                                    onchange="previewAboutImage(this, 'aboutImage2Preview')">
                                @php($image2Url = !empty($aboutSection?->image2) ? \Illuminate\Support\Facades\Storage::url($aboutSection->image2) : '')
                                <img id="aboutImage2Preview" src="{{ $image2Url }}" alt=""
                                    style="display:{{ $image2Url ? '' : 'none' }};margin-top:8px;max-height:120px;border-radius:6px;border:1px solid var(--grey-200);">
                            </div>
                            <div class="form-section">
                                <label class="field-label">Image Position</label>
                                <select class="form-field" name="aboutImage2Position" id="aboutImage2Position">
                                    @foreach (['left' => 'Left', 'right' => 'Right', 'top' => 'Top', 'bottom' => 'Bottom'] as $value => $label)
                                        <option value="{{ $value }}" {{ old('aboutImage2Position', $aboutSection->aboutImage2Position ?? 'left') === $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn-save">
                    <span class="btn-label"><i class="fas fa-floppy-disk"></i> Save About Section</span>
                    <span class="spinner"></span>
                </button>
                <button type="button" class="btn-reset" onclick="location.reload()">Reset</button>
            </div>
        </form>
    </div>

    <script>
        function previewAboutImage(input, previewId) {
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
    </script>

@endsection
