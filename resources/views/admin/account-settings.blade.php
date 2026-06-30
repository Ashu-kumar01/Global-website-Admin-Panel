@extends('adminlayout.app')
@section('title', 'Account Settings')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Account Settings</h2>
                <p>Manage your account preferences and security options.</p>
            </div>
        </div>

        <div style="display:flex;flex-direction:column;gap:24px;max-width:760px;">

            <!-- Account info -->
            <div class="panel">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-user-gear"></i> Account Information</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;gap:14px;flex-wrap:wrap;">
                        <div class="form-section" style="flex:1;min-width:200px;">
                            <label class="field-label">Name</label>
                            <input type="text" class="form-field" value="{{ $users->name }}" readonly>
                        </div>
                        <div class="form-section" style="flex:1;min-width:200px;">
                            <label class="field-label">Email</label>
                            <input type="text" class="form-field" value="{{ $users->email_id }}" readonly>
                        </div>
                    </div>
                    <div class="form-section">
                        <label class="field-label">Mobile Number</label>
                        <input type="text" class="form-field" value="{{ $users->mobile_number }}" readonly>
                    </div>
                </div>
            </div>

            <!-- Notifications -->
            <div class="panel">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-bell"></i> Notification Preferences</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--grey-100);">
                        <div>
                            <strong style="font-size:.88rem;">Email Notifications</strong>
                            <p style="margin:2px 0 0;font-size:.78rem;color:var(--grey-500);">Receive updates and alerts via email.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--grey-100);">
                        <div>
                            <strong style="font-size:.88rem;">SMS Notifications</strong>
                            <p style="margin:2px 0 0;font-size:.78rem;color:var(--grey-500);">Receive important alerts via SMS.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
                        <div>
                            <strong style="font-size:.88rem;">Marketing Emails</strong>
                            <p style="margin:2px 0 0;font-size:.78rem;color:var(--grey-500);">Tips, product news and offers.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Security -->
            <div class="panel">
                <div class="panel-head">
                    <h3 class="panel-head-title"><i class="fas fa-lock"></i> Security</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--grey-100);">
                        <div>
                            <strong style="font-size:.88rem;">Password</strong>
                            <p style="margin:2px 0 0;font-size:.78rem;color:var(--grey-500);">Last changed: not tracked.</p>
                        </div>
                        <a href="{{ route('admin.password.edit') }}" class="btn-reset">Change Password</a>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;">
                        <div>
                            <strong style="font-size:.88rem;">Two-Factor Authentication</strong>
                            <p style="margin:2px 0 0;font-size:.78rem;color:var(--grey-500);">Add an extra layer of security to your account.</p>
                        </div>
                        <label class="switch">
                            <input type="checkbox">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Danger zone -->
            <div class="panel">
                <div class="panel-head">
                    <h3 class="panel-head-title" style="color:var(--red-600,#dc2626);"><i class="fas fa-triangle-exclamation"></i> Danger Zone</h3>
                </div>
                <div class="panel-body">
                    <div style="display:flex;justify-content:space-between;align-items:center;">
                        <div>
                            <strong style="font-size:.88rem;">Deactivate Account</strong>
                            <p style="margin:2px 0 0;font-size:.78rem;color:var(--grey-500);">Temporarily disable your account.</p>
                        </div>
                        <button type="button" class="btn-reset" style="border-color:var(--red-600,#dc2626);color:var(--red-600,#dc2626);">Deactivate</button>
                    </div>
                </div>
            </div>

            <div class="form-footer">
                <button type="button" class="btn-save">
                    <span class="btn-label"><i class="fas fa-floppy-disk"></i> Save Changes</span>
                </button>
            </div>

        </div>
    </div>

    <style>
        .switch { position: relative; display: inline-block; width: 42px; height: 24px; flex-shrink: 0; }
        .switch input { opacity: 0; width: 0; height: 0; }
        .switch .slider { position: absolute; cursor: pointer; inset: 0; background-color: var(--grey-200, #e5e7eb); border-radius: 24px; transition: .2s; }
        .switch .slider::before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: #fff; border-radius: 50%; transition: .2s; }
        .switch input:checked + .slider { background-color: var(--blue-600, #2563eb); }
        .switch input:checked + .slider::before { transform: translateX(18px); }
    </style>

@endsection
