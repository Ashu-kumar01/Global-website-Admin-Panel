@php
    use Illuminate\Support\Facades\Storage;

    $design = $section->design_type ?? 'grid';
    $logos = ($section->logos ?? collect())->filter(fn ($l) => $l->image);
    $marqueeId = 'placementMarquee' . $section->id;
    $stats = collect([
        ['label' => 'Highest Package', 'value' => $section->highest_package ?? null],
        ['label' => 'Average Package', 'value' => $section->average_package ?? null],
        ['label' => 'Total Recruiters', 'value' => $section->total_recruiters ?? null],
    ])->filter(fn ($s) => filled($s['value']));

    $resolveLink = function (?string $link) {
        if (! $link) {
            return null;
        }

        return \Illuminate\Support\Facades\Route::has($link) ? route($link) : $link;
    };
@endphp

@if ($section->heading || $section->subheading || $stats->isNotEmpty() || $logos->isNotEmpty())
<section class="pl-section">
    <div class="pl-container">
        @if ($section->badge || $section->heading || $section->subheading)
            <div class="pl-header">
                @if ($section->badge)
                    <span class="pl-badge">{{ $section->badge }}</span>
                @endif
                @if ($section->heading)
                    <h2 class="pl-heading">{{ $section->heading }}</h2>
                @endif
                @if ($section->subheading)
                    <p class="pl-subheading">{{ $section->subheading }}</p>
                @endif
            </div>
        @endif

        @if ($stats->isNotEmpty())
            <div class="pl-stats">
                @foreach ($stats as $stat)
                    <div class="pl-stat">
                        <div class="pl-stat-value">{{ $stat['value'] }}</div>
                        <div class="pl-stat-label">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($logos->isNotEmpty())
            @if ($design === 'marquee')
                <div class="pl-marquee-wrap">
                    <div class="pl-marquee-track" id="{{ $marqueeId }}">
                        @foreach ([1, 2] as $loop)
                            @foreach ($logos as $logo)
                                <div class="pl-logo-item" title="{{ $logo->company_name }}">
                                    @if ($resolveLink($logo->link))
                                        <a href="{{ $resolveLink($logo->link) }}" target="_blank" rel="noopener">
                                            <img src="{{ Storage::url($logo->image) }}" alt="{{ $logo->company_name ?: 'Recruiter logo' }}">
                                        </a>
                                    @else
                                        <img src="{{ Storage::url($logo->image) }}" alt="{{ $logo->company_name ?: 'Recruiter logo' }}">
                                    @endif
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            @else
                <div class="pl-logos">
                    @foreach ($logos as $logo)
                        <div class="pl-logo-item" title="{{ $logo->company_name }}">
                            @if ($resolveLink($logo->link))
                                <a href="{{ $resolveLink($logo->link) }}" target="_blank" rel="noopener">
                                    <img src="{{ Storage::url($logo->image) }}" alt="{{ $logo->company_name ?: 'Recruiter logo' }}">
                                </a>
                            @else
                                <img src="{{ Storage::url($logo->image) }}" alt="{{ $logo->company_name ?: 'Recruiter logo' }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
    </div>
</section>

<style>
    .pl-section { padding: 80px 0; background: #ffffff; }
    .pl-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .pl-header { max-width: 720px; margin: 0 auto 48px; text-align: center; }
    .pl-badge { display: inline-block; padding: 6px 16px; border-radius: 999px; background: rgba(37,99,235,.1); color: #2563eb; font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; margin-bottom: 16px; }
    .pl-heading { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; margin: 0 0 12px; line-height: 1.25; }
    .pl-subheading { font-size: 1rem; color: #6b7280; line-height: 1.6; margin: 0; }

    .pl-stats { display: flex; justify-content: center; gap: 24px; flex-wrap: wrap; margin-bottom: 56px; }
    .pl-stat { flex: 1; min-width: 200px; max-width: 280px; text-align: center; padding: 32px 20px; border-radius: 14px; background: #f8fafc; border: 1px solid #e5e7eb; }
    .pl-stat-value { font-size: 2.2rem; font-weight: 800; color: #2563eb; line-height: 1.1; margin-bottom: 8px; }
    .pl-stat-label { font-size: .92rem; color: #6b7280; font-weight: 600; }

    .pl-logos { display: grid; grid-template-columns: repeat(7, 1fr); gap: 20px; align-items: center; }
    .pl-logo-item { display: flex; align-items: center; justify-content: center; padding: 16px; border-radius: 10px; background: #f8fafc; border: 1px solid #e5e7eb; transition: transform .25s ease, box-shadow .25s ease; }
    .pl-logo-item:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(15,23,42,.1); }
    .pl-logo-item img { max-width: 100%; max-height: 48px; object-fit: contain; filter: grayscale(100%); opacity: .75; transition: filter .25s ease, opacity .25s ease; }
    .pl-logo-item:hover img { filter: grayscale(0%); opacity: 1; }

    @media (max-width: 1024px) { .pl-logos { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 640px) { .pl-logos { grid-template-columns: repeat(2, 1fr); } .pl-stats { flex-direction: column; align-items: center; } }

    .pl-marquee-wrap { width: 100%; overflow: hidden; -webkit-mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); mask-image: linear-gradient(90deg, transparent, #000 8%, #000 92%, transparent); }
    .pl-marquee-track { display: flex; align-items: center; gap: 20px; width: max-content; animation: pl-scroll 30s linear infinite; }
    .pl-marquee-track:hover { animation-play-state: paused; }
    .pl-marquee-track .pl-logo-item { flex: 0 0 auto; width: 160px; }
    @keyframes pl-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
</style>
@endif
