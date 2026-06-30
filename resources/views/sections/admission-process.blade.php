@php
    $steps = $section->steps ?? collect();

    $resolveLink = function (?string $link) {
        if (! $link) {
            return '#';
        }

        return \Illuminate\Support\Facades\Route::has($link) ? route($link) : $link;
    };
@endphp

@if ($section->heading || $section->subheading || $steps->isNotEmpty())
<section class="ap-section">
    <div class="ap-container">
        @if ($section->badge || $section->heading || $section->subheading)
            <div class="ap-header">
                @if ($section->badge)
                    <span class="ap-badge">{{ $section->badge }}</span>
                @endif
                @if ($section->heading)
                    <h2 class="ap-heading">{{ $section->heading }}</h2>
                @endif
                @if ($section->subheading)
                    <p class="ap-subheading">{{ $section->subheading }}</p>
                @endif
            </div>
        @endif

        @if ($steps->isNotEmpty())
            <div class="ap-timeline">
                @foreach ($steps as $index => $step)
                    <div class="ap-step">
                        <div class="ap-step-marker">
                            @if ($step->icon)
                                <i class="{{ $step->icon }}"></i>
                            @else
                                <span class="ap-step-number">{{ $index + 1 }}</span>
                            @endif
                        </div>
                        <div class="ap-step-body">
                            @if ($step->heading)
                                <h3 class="ap-step-heading">{{ $step->heading }}</h3>
                            @endif
                            @if ($step->subheading)
                                <p class="ap-step-subheading">{{ $step->subheading }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($section->cta_text)
            <div class="ap-cta-wrap">
                <a href="{{ $resolveLink($section->cta_link) }}" class="ap-cta">{{ $section->cta_text }}</a>
            </div>
        @endif
    </div>
</section>

<style>
    .ap-section { padding: 80px 0; background: #f8fafc; }
    .ap-container { max-width: 1000px; margin: 0 auto; padding: 0 24px; }
    .ap-header { max-width: 720px; margin: 0 auto 48px; text-align: center; }
    .ap-badge { display: inline-block; padding: 6px 16px; border-radius: 999px; background: rgba(37,99,235,.1); color: #2563eb; font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; margin-bottom: 16px; }
    .ap-heading { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; margin: 0 0 12px; line-height: 1.25; }
    .ap-subheading { font-size: 1rem; color: #6b7280; line-height: 1.6; margin: 0; }

    .ap-timeline { position: relative; display: flex; flex-direction: column; gap: 36px; }
    .ap-timeline::before { content: ''; position: absolute; left: 27px; top: 8px; bottom: 8px; width: 2px; background: #e5e7eb; }
    .ap-step { position: relative; display: flex; gap: 24px; align-items: flex-start; }
    .ap-step-marker { position: relative; z-index: 1; flex-shrink: 0; width: 56px; height: 56px; border-radius: 50%; background: #2563eb; color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; box-shadow: 0 6px 18px rgba(37,99,235,.35); }
    .ap-step-number { font-size: 1.2rem; font-weight: 700; }
    .ap-step-body { flex: 1; padding-top: 6px; }
    .ap-step-heading { font-size: 1.15rem; font-weight: 700; margin: 0 0 8px; }
    .ap-step-subheading { font-size: .92rem; color: #6b7280; line-height: 1.6; margin: 0; }

    .ap-cta-wrap { text-align: center; margin-top: 48px; }
    .ap-cta { display: inline-flex; align-items: center; justify-content: center; padding: 12px 28px; border-radius: 8px; background: #2563eb; color: #ffffff; font-size: .92rem; font-weight: 600; text-decoration: none; transition: background-color .25s ease; }
    .ap-cta:hover { background: #1e40af; }

    @media (max-width: 640px) {
        .ap-step-marker { width: 44px; height: 44px; font-size: 1.05rem; }
        .ap-timeline::before { left: 21px; }
    }
</style>
@endif
