@extends('adminlayout.app')
@section('title', 'Change Password')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Change Password</h2>
                <p>Update your account password.</p>
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

        <div class="panel">
            <div class="panel-head">
                <h3 class="panel-head-title"><i class="fas fa-shield-halved"></i> Password Settings</h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{ route('admin.password.update') }}">
                    @csrf

                    <div class="form-section">
                        <label class="field-label">Current Password</label>
                        <input type="password" name="current_password" class="form-field @error('current_password') is-invalid @enderror">
                        @error('current_password')
                            <div class="field-error show">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-section">
                        <label class="field-label">New Password</label>
                        <input type="password" name="password" class="form-field @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="field-error show">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-section">
                        <label class="field-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-field">
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn-save">
                            <span class="btn-label"><i class="fas fa-floppy-disk"></i> Update Password</span>
                            <span class="spinner"></span>
                        </button>
                        <a href="{{ route('admin.dashboard') }}" class="btn-reset">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
