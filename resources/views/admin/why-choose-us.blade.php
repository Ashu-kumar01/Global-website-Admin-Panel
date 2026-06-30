@extends('adminlayout.app')
@section('title', 'Section Header')
@section('adminContent')

    <div class="page-content">

        <div class="page-header">
            <div class="page-title">
                <h2>Section Header</h2>
                <p>Configure the badge, heading, layout and cards for this dynamic section.</p>
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
    </div>
@endsection
