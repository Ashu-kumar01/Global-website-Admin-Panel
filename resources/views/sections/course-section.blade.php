@php
    use Illuminate\Support\Facades\Storage;

    $design = $section->design_type ?? 'grid';
    $cards = $section->cards ?? collect();
    $sliderId = 'courseSlider' . $section->id;

    $resolveLink = function (?string $link) {
        if (! $link) {
            return '#';
        }

        return \Illuminate\Support\Facades\Route::has($link) ? route($link) : $link;
    };

    $courseMeta = function ($card) {
        $type = match ($card->course_type ?? null) {
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            default => null,
        };

        return collect([$type, $card->duration ?? null])->filter()->implode(' · ') ?: null;
    };
@endphp

@if ($section->heading || $section->subheading || $cards->isNotEmpty() || $section->image)
<section class="cs-section">
    <div class="cs-container">
        @if ($section->heading || $section->subheading)
            <div class="cs-header">
                @if ($section->heading)
                    <h2 class="cs-heading">{{ $section->heading }}</h2>
                @endif
                @if ($section->subheading)
                    <p class="cs-subheading">{{ $section->subheading }}</p>
                @endif
            </div>
        @endif

        @if ($design === 'grid')
            <div class="cs-grid cs-grid-4">
                @foreach ($cards as $card)
                    <div class="cs-card cs-card-image" style="background-color:#ffffff;">
                        @if ($card->image)
                            <div class="cs-card-image-wrap">
                                <img src="{{ Storage::url($card->image) }}" alt="{{ $card->heading }}">
                            </div>
                        @endif
                        <div class="cs-card-body">
                            @if ($card->badge)
                                <span class="cs-badge">{{ $card->badge }}</span>
                            @endif
                            @if ($card->heading)
                                <h3 class="cs-card-heading">{{ $card->heading }}</h3>
                            @endif
                            @if ($card->subheading)
                                <p class="cs-card-subheading">{{ $card->subheading }}</p>
                            @endif
                            @if ($courseMeta($card))
                                <p class="cs-card-meta">{{ $courseMeta($card) }}</p>
                            @endif
                            @if ($card->explore_text)
                                <a href="{{ $resolveLink($card->explore_link) }}" class="cs-card-cta">{{ $card->explore_text }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($design === 'image')
            <div class="cs-program" style="flex-direction:{{ ($section->image_position ?? 'left') === 'right' ? 'row-reverse' : 'row' }};">
                @if ($section->image)
                    <div class="cs-program-image">
                        <img src="{{ Storage::url($section->image) }}" alt="{{ $section->heading }}">
                    </div>
                @endif
                <div class="cs-program-cards">
                    @foreach ($cards as $card)
                        <div class="cs-program-card">
                            @if ($card->heading)
                                <h3 class="cs-program-card-heading">{{ $card->heading }}</h3>
                            @endif
                            @if ($card->subheading)
                                <p class="cs-program-card-subheading">{{ $card->subheading }}</p>
                            @endif
                            @if ($card->short_description)
                                <p class="cs-program-card-desc">{{ $card->short_description }}</p>
                            @endif
                            @if ($courseMeta($card))
                                <p class="cs-card-meta">{{ $courseMeta($card) }}</p>
                            @endif
                            @if ($card->explore_text)
                                <a href="{{ $resolveLink($card->explore_link) }}" class="cs-card-cta">{{ $card->explore_text }}</a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif ($design === 'slider')
            <div class="cs-slider" id="{{ $sliderId }}">
                @foreach ($cards as $card)
                    <div class="cs-slide">
                        <div class="cs-card cs-card-image" style="background-color:{{ $card->background_color ?: '#ffffff' }};">
                            @if ($card->image)
                                <div class="cs-card-image-wrap">
                                    <img src="{{ Storage::url($card->image) }}" alt="{{ $card->heading }}">
                                </div>
                            @endif
                            <div class="cs-card-body">
                                @if ($card->badge)
                                    <span class="cs-badge">{{ $card->badge }}</span>
                                @endif
                                @if ($card->heading)
                                    <h3 class="cs-card-heading">{{ $card->heading }}</h3>
                                @endif
                                @if ($card->subheading)
                                    <p class="cs-card-subheading">{{ $card->subheading }}</p>
                                @endif
                                @if ($courseMeta($card))
                                    <p class="cs-card-meta">{{ $courseMeta($card) }}</p>
                                @endif
                                @if ($card->explore_text)
                                    <a href="{{ $resolveLink($card->explore_link) }}" class="cs-card-cta">{{ $card->explore_text }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
    .cs-section { padding: 80px 0; background: #ffffff; }
    .cs-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .cs-header { max-width: 720px; margin: 0 auto 48px; text-align: center; }
    .cs-heading { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; margin: 0 0 12px; line-height: 1.25; }
    .cs-subheading { font-size: 1rem; color: #6b7280; line-height: 1.6; margin: 0; }

    .cs-grid { display: grid; gap: 24px; }
    .cs-grid-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .cs-grid-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    @media (max-width: 1024px) { .cs-grid-4, .cs-grid-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 640px) { .cs-grid-4, .cs-grid-3 { grid-template-columns: 1fr; } }

    .cs-card { position: relative; border-radius: 12px; box-shadow: 0 6px 24px rgba(15, 23, 42, .08); transition: transform .3s ease, box-shadow .3s ease; overflow: hidden; }
    .cs-card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(15, 23, 42, .16); }
    .cs-card-plain { background: #ffffff; padding: 28px; display: flex; flex-direction: column; }
    .cs-card-image { display: flex; flex-direction: column; }
    .cs-card-image-wrap { width: 100%; aspect-ratio: 16/10; overflow: hidden; }
    .cs-card-image-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform .4s ease; }
    .cs-card:hover .cs-card-image-wrap img { transform: scale(1.06); }
    .cs-card-body { padding: 24px; display: flex; flex-direction: column; flex: 1; }

    .cs-badge { display: inline-block; align-self: flex-start; padding: 4px 12px; border-radius: 999px; background: rgba(37,99,235,.1); color: #2563eb; font-size: .72rem; font-weight: 600; letter-spacing: .03em; text-transform: uppercase; margin-bottom: 12px; }
    .cs-card-heading { font-size: 1.1rem; font-weight: 700; margin: 0 0 8px; }
    .cs-card-subheading { font-size: .9rem; color: #6b7280; line-height: 1.55; margin: 0 0 16px; flex: 1; }
    .cs-card-meta { font-size: .8rem; color: #2563eb; font-weight: 600; margin: -8px 0 16px; }
    .cs-card-cta { display: inline-flex; align-items: center; justify-content: center; align-self: flex-start; padding: 10px 22px; border-radius: 8px; background: #2563eb; color: #ffffff; font-size: .86rem; font-weight: 600; text-decoration: none; transition: background-color .25s ease; }
    .cs-card-cta:hover { background: #1e40af; }

    .cs-program { display: flex; align-items: flex-start; gap: 48px; }
    .cs-program-image { flex: 1; border-radius: 12px; overflow: hidden; box-shadow: 0 6px 24px rgba(15, 23, 42, .08); position: sticky; top: 24px; }
    .cs-program-image img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .cs-program-cards { flex: 1; display: flex; flex-direction: column; gap: 28px; }
    .cs-program-card { padding-bottom: 28px; border-bottom: 1px solid #e5e7eb; }
    .cs-program-card:last-child { border-bottom: none; padding-bottom: 0; }
    .cs-program-card-heading { font-size: 1.25rem; font-weight: 700; margin: 0 0 8px; }
    .cs-program-card-subheading { font-size: .95rem; color: #2563eb; font-weight: 600; margin: 0 0 10px; }
    .cs-program-card-desc { font-size: .92rem; color: #6b7280; line-height: 1.6; margin: 0 0 16px; }
    @media (max-width: 768px) { .cs-program { flex-direction: column !important; } .cs-program-image { position: static; } }

    .cs-slider .cs-slide { padding: 0 12px; }
    .cs-slider .cs-card { margin-bottom: 4px; }
    .cs-slider .slick-list { margin: 0 -12px; }
    .cs-slider .slick-dots { bottom: -36px; }
</style>

@once
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
    @if (! isset($withoutJquery))
        <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
@endonce

@if ($design === 'slider' && $cards->isNotEmpty())
    <script>
        (function () {
            function initCourseSlider() {
                jQuery('#{{ $sliderId }}').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: true,
                    infinite: {{ $cards->count() > 3 ? 'true' : 'false' }},
                    speed: 600,
                    responsive: [
                        { breakpoint: 1024, settings: { slidesToShow: 2 } },
                        { breakpoint: 640, settings: { slidesToShow: 1 } }
                    ]
                });
            }
            if (window.jQuery && jQuery.fn.slick) {
                initCourseSlider();
            } else {
                window.addEventListener('load', initCourseSlider);
            }
        })();
    </script>
@endif
@endif
