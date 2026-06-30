@extends('adminlayout.app')
@section('title', 'My Profile')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>My Profile</h2>
                <p>View and manage your account information.</p>
            </div>
        </div>

        <form action="{{ route('admin.profile.save') }}" method="post">
            @csrf
            <div style="display:flex;gap:24px;flex-wrap:wrap;align-items:flex-start;">

                <!-- Profile summary card -->
                <div class="panel" style="flex:0 0 280px;">
                    <div class="panel-body" style="text-align:center;padding:28px 20px;">
                        <img src="{{ $user->logo ? asset($user->logo) : asset('logo.png') }}" alt="Profile photo"
                            style="width:96px;height:96px;border-radius:50%;object-fit:cover;border:3px solid var(--grey-200);margin-bottom:14px;">
                        <h3 style="margin:0 0 4px;">{{ $user->name }}</h3>
                        <p style="margin:0 0 14px;color:var(--grey-500);font-size:.85rem;">{{ $user->email_id }}</p>
                        <span class="field-error show"
                            style="display:inline-block;background:var(--blue-50,#eff6ff);color:var(--blue-600,#2563eb);padding:6px 14px;border-radius:20px;font-size:.78rem;">
                            <i class="fas fa-shield-halved"></i> Administrator
                        </span>

                        <div style="margin-top:22px;text-align:left;font-size:.84rem;color:var(--grey-600);">
                            <div
                                style="display:flex;justify-content:space-between;padding:8px 0;border-top:1px solid var(--grey-100);">
                                <span>Mobile</span><strong>{{ $user->mobile_number }}</strong>
                            </div>
                            <div
                                style="display:flex;justify-content:space-between;padding:8px 0;border-top:1px solid var(--grey-100);">
                                <span>Website</span><strong>{{ $user->website_name }}</strong>
                            </div>
                            <div
                                style="display:flex;justify-content:space-between;padding:8px 0;border-top:1px solid var(--grey-100);">
                                <span>Joined</span><strong>{{ $user->created_at?->format('d M Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Details -->

                <div style="flex:1;min-width:320px;display:flex;flex-direction:column;gap:24px;">

                    <div class="panel">
                        <div class="panel-head">
                            <h3 class="panel-head-title"><i class="fas fa-id-card"></i> Personal Information</h3>
                        </div>
                        <div class="panel-body">
                            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">First Name</label>
                                    <input type="text" class="form-field" name="fname" value="{{ $user->fname }}"
                                        @readonly(empty($users?->id))>
                                </div>
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Last Name</label>
                                    <input type="text" class="form-field" name="lname" value="{{ $user->lname }}"
                                        @readonly(empty($users?->id))>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Email</label>
                                    <input type="text" class="form-field" name="email" value="{{ $user->email_id }}"
                                        @readonly(true) @disabled(true)>
                                </div>
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Mobile Number</label>
                                    <input type="text" class="form-field" name="mobile_number"
                                        value="{{ $user->mobile_number }}" @readonly(true) @disabled(true)>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-head">
                            <h3 class="panel-head-title"><i class="fas fa-building"></i> Organisation</h3>
                        </div>
                        <div class="panel-body">
                            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Organisation Name</label>
                                    <input type="text" class="form-field" name="organisation_name"
                                        value="{{ $user->organisation_name }}" @readonly(empty($users?->id))>
                                </div>
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Website Name</label>
                                    <input type="text" class="form-field" name="website_name"
                                        value="{{ $user->website_name }}" @readonly(empty($users?->id))>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Domain</label>
                                    <select class="form-field" name="domain"
                                        style="width:100%;min-width:95px;flex-shrink:0" @readonly(empty($users?->id))>
                                        @foreach (['.com', '.in', '.org', '.net', '.co.in', '.edu.in'] as $d)
                                            <option @selected(old('domain') === $d) @selected($user->domain == $d)
                                                @disabled($users?->id ? false : true)>
                                                {{ $d }}</option>
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-field" value="{{ $user->domain }}" @readonly(empty($users?->id))> --}}
                                </div>
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label">Website Type</label>
                                    <select id="web-type" name="website_type" class="form-field" @readonly(empty($users?->id))>
                                        <option value="" @disabled($users?->id ? false : true)>Select your website category
                                        </option>
                                        @foreach (['Corporate / Business', 'E-commerce / Online Store', 'Portfolio / Creative Agency', 'Healthcare / Medical Clinic', 'Restaurant / Food & Dining', 'Real Estate / Property', 'School', 'College', 'University', 'NGO / Non-Profit', 'Blog / News Portal', 'Other'] as $type)
                                            <option @selected(old('website_type') === $type) @selected($user->website_type == $type)
                                                @disabled($users?->id ? false : true)>
                                                {{ $type }}</option>
                                        @endforeach
                                    </select>

                                    {{-- <input type="text" class="form-field" value="{{ $user->website_type }}"
                                        @readonly(empty($users?->id))> --}}
                                </div>
                            </div>
                            <div class="form-section">
                                <label class="field-label">Description</label>
                                <textarea class="form-field" name="web_descroption" rows="3" @readonly(empty($users?->id))>{{ $user->web_descroption }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-head">
                            <h3 class="panel-head-title"><i class="fas fa-share-nodes"></i> Social Links</h3>
                        </div>
                        <div class="panel-body">
                            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label"><i class="fab fa-facebook"></i> Facebook</label>
                                    <input type="text" class="form-field" name="facebook"
                                        value="{{ $user->facebook }}" @readonly(empty($users?->id))>
                                </div>
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label"><i class="fab fa-instagram"></i> Instagram</label>
                                    <input type="text" class="form-field" name="instagram"
                                        value="{{ $user->instagram }}" @readonly(empty($users?->id))>
                                </div>
                            </div>
                            <div style="display:flex;gap:14px;flex-wrap:wrap;">
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label"><i class="fab fa-twitter"></i> Twitter</label>
                                    <input type="text" class="form-field" name="twitter"
                                        value="{{ $user->twitter }}" @readonly(empty($users?->id))>
                                </div>
                                <div class="form-section" style="flex:1;min-width:200px;">
                                    <label class="field-label"><i class="fab fa-linkedin"></i> LinkedIn</label>
                                    <input type="text" class="form-field" name="linkedin"
                                        value="{{ $user->linkedIn }}" @readonly(empty($users?->id))>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-footer">

                        @if ($users?->id)
                            <button type="submit" class="btn-save" id="saveChanges">
                                <span class="btn-label">
                                    <i class="fas fa-pen"></i>
                                    Save Changes
                                </span>
                            </button>
                            <a href="{{ route('admin.profile') }}" class="btn-reset" id="editMode">
                                <span class="btn-label">
                                    <i class="fas fa-times"></i>
                                    Close Edit Mode
                                </span>
                            </a>
                        @else
                            <a href="{{ route('admin.profile', $user->id) }}" class="btn-save" id="editbtn">
                                <span class="btn-label">
                                    <i class="fas fa-pen"></i>
                                    Edit Profile
                                </span>
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        </form>
    </div>

@endsection
