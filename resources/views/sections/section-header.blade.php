@php
    use Illuminate\Support\Facades\Storage;

    $layout = $section->layout_type ?? 'grid';
    $cards = $section->cards ?? collect();

    $gradientCss = function ($type, $color1, $color2, $angle) {
        $type = $type ?: 'linear';
        $color1 = $color1 ?: '#2563eb';
        $color2 = $color2 ?: '#1e3a8a';
        $angle = $angle ?: 135;

        return match ($type) {
            'radial' => "radial-gradient(circle, {$color1}, {$color2})",
            'diagonal' => "linear-gradient({$angle}deg, {$color1}, {$color2})",
            'vertical' => "linear-gradient(180deg, {$color1}, {$color2})",
            'horizontal' => "linear-gradient(90deg, {$color1}, {$color2})",
            default => "linear-gradient({$angle}deg, {$color1}, {$color2})",
        };
    };

    $sectionStyle = match ($section->section_background_type ?? 'color') {
        'image' => $section->section_background_image
            ? "background-image:url('" . Storage::url($section->section_background_image) . "');background-size:cover;background-position:center;"
            : '',
        'gradient' => $section->section_background_image
            ? "background-image:url('" . Storage::url($section->section_background_image) . "');background-size:cover;background-position:center;"
            : 'background:' . $gradientCss(
                $section->section_gradient_type,
                $section->section_gradient_color_1,
                $section->section_gradient_color_2,
                $section->section_gradient_angle
            ) . ';',
        default => 'background-color:' . ($section->section_background_color ?: '#ffffff') . ';',
    };

    $sectionGradientOverlay = ($section->section_background_type ?? 'color') === 'gradient' && $section->section_background_image
        ? $gradientCss(
            $section->section_gradient_type,
            $section->section_gradient_color_1,
            $section->section_gradient_color_2,
            $section->section_gradient_angle
        ) . ';opacity:' . (($section->section_gradient_opacity ?? 100) / 100) . ';'
        : null;

    $sectionStyle .= 'padding-top:' . ($section->padding_top ?? 80) . 'px;padding-bottom:' . ($section->padding_bottom ?? 80) . 'px;';

    $renderCardStyle = function ($card) use ($gradientCss) {
        $style = 'border-radius:' . ($card->image_border_radius ?? 12) . 'px;';

        $bgType = $card->background_type ?? 'color';
        if ($bgType === 'image' && $card->background_image) {
            $style .= "background-image:url('" . Storage::url($card->background_image) . "');";
            $style .= 'background-size:' . ($card->image_size ?: 'cover') . ';background-position:' . ($card->image_position ?: 'center') . ';';
        } elseif ($bgType === 'gradient') {
            $style .= 'background:' . $gradientCss($card->gradient_type, $card->gradient_color_1, $card->gradient_color_2, $card->gradient_angle) . ';';
        } else {
            $style .= 'background-color:' . ($card->background_color ?: '#ffffff') . ';';
        }

        return $style;
    };

    $overlayStyle = function ($card) {
        $color = $card->background_type === 'image' ? ($card->image_overlay_color ?: '#000000') : ($card->overlay_color ?: '#000000');
        $opacity = $card->background_type === 'image' ? ($card->image_overlay_opacity ?? 0) : ($card->overlay_opacity ?? 0);
        if ((int) $opacity <= 0) {
            return null;
        }

        return 'background-color:' . $color . ';opacity:' . ($opacity / 100) . ';';
    };

    $buttonStyle = function ($card) {
        $style = 'border-radius:' . ($card->button_radius ?? 8) . 'px;';
        $bg = $card->button_bg_color ?: '#2563eb';
        $text = $card->button_text_color ?: '#ffffff';

        return match ($card->button_style ?? 'filled') {
            'outline' => $style . "background-color:transparent;border:2px solid {$bg};color:{$bg};",
            'ghost' => $style . "background-color:transparent;border:none;color:{$bg};",
            default => $style . "background-color:{$bg};border:2px solid {$bg};color:{$text};",
        };
    };

    $headingHtml = function ($section) {
        $heading = e($section->heading ?? '');
        if ($section->heading_accent_text && str_contains($section->heading ?? '', $section->heading_accent_text)) {
            $accent = e($section->heading_accent_text);
            $color = $section->heading_accent_color ?: '#2563eb';
            $heading = str_replace($accent, '<span style="color:' . $color . '">' . $accent . '</span>', $heading);
        }

        return $heading;
    };

    $richText = function (?string $text) {
        if (! $text) {
            return '';
        }

        $blocks = preg_split('/\n\s*\n/', trim($text));
        $html = '';

        foreach ($blocks as $block) {
            $lines = array_values(array_filter(array_map('trim', explode("\n", $block)), fn ($l) => $l !== ''));
            if (empty($lines)) {
                continue;
            }

            $isList = array_reduce($lines, fn ($carry, $l) => $carry && (str_starts_with($l, '- ') || str_starts_with($l, '* ')), true);

            if ($isList) {
                $html .= '<ul class="sh-subheading-list">';
                foreach ($lines as $line) {
                    $html .= '<li>' . e(ltrim($line, '-* ')) . '</li>';
                }
                $html .= '</ul>';
            } else {
                $html .= '<p>' . implode('<br>', array_map('e', $lines)) . '</p>';
            }
        }

        return $html;
    };

    $resolveLink = function (?string $link) {
        if (! $link) {
            return '#';
        }

        return \Illuminate\Support\Facades\Route::has($link) ? route($link) : $link;
    };
@endphp

<section class="sh-section sh-layout-{{ $layout }}" style="{{ $sectionStyle }}">
    @if ($sectionGradientOverlay)
        <div class="sh-section-overlay" style="position:absolute;inset:0;background:{{ $sectionGradientOverlay }}"></div>
    @endif
    <div class="sh-container">
        @if ($section->badge || $section->heading || $section->subheading)
            <div class="sh-header" style="text-align:{{ $section->alignment ?? 'center' }};">
                @if ($section->badge)
                    <span class="sh-badge">{{ $section->badge }}</span>
                @endif
                @if ($section->heading)
                    <h2 class="sh-heading" style="{{ $section->heading_color ? 'color:' . $section->heading_color . ';' : '' }}">{!! $headingHtml($section) !!}</h2>
                @endif
                @if ($section->subheading)
                    <div class="sh-subheading" style="{{ $section->subheading_color ? 'color:' . $section->subheading_color . ';' : '' }}">{!! $richText($section->subheading) !!}</div>
                @endif
                @if ($section->cta_text)
                    <a href="{{ $resolveLink($section->cta_link) }}" class="sh-card-cta sh-section-cta">{{ $section->cta_text }}</a>
                @endif
            </div>
        @endif

        @if ($layout === 'grid')
            <div class="sh-grid"
                 style="--sh-cols-desktop:{{ $section->grid_columns_desktop ?? 3 }};--sh-cols-tablet:{{ $section->grid_columns_tablet ?? 2 }};--sh-cols-mobile:{{ $section->grid_columns_mobile ?? 1 }};--sh-gap:{{ $section->grid_gap ?? 24 }}px;--sh-card-radius:{{ $section->card_border_radius ?? 12 }}px;--sh-card-height:{{ $section->card_height ? $section->card_height . 'px' : 'auto' }};justify-content:{{ $section->card_alignment === 'left' ? 'start' : ($section->card_alignment === 'right' ? 'end' : 'center') }};">
                @foreach ($cards as $card)
                    <div class="sh-card sh-hover-{{ $section->hover_animation ?? 'lift' }} sh-anim-{{ $card->animation_type ?? 'fade-up' }} {{ $section->card_shadow ? 'sh-shadow' : '' }} {{ $section->hover_shadow ? 'sh-hover-shadow' : '' }}"
                         style="{{ $renderCardStyle($card) }}animation-delay:{{ $card->animation_delay ?? 0 }}ms;">
                        @if ($overlayStyle($card))
                            <div class="sh-card-overlay" style="{{ $overlayStyle($card) }}"></div>
                        @endif
                        <div class="sh-card-inner">
                            @if ($card->card_type === 'icon' && $card->icon)
                                <div class="sh-icon-wrap" style="color:{{ $card->icon_color ?: '#2563eb' }};background-color:{{ $card->icon_bg_color ?: '#eff6ff' }};">
                                    <i class="{{ $card->icon }}"></i>
                                </div>
                            @endif

                            @if ($card->heading)
                                <h3 class="sh-card-heading">{{ $card->heading }}</h3>
                            @endif
                            @if ($card->subheading)
                                <p class="sh-card-subheading">{{ $card->subheading }}</p>
                            @endif

                            @if (in_array($card->card_type, ['image', 'cta']) && $card->cta_text)
                                <a href="{{ $card->cta_link ?: '#' }}" class="sh-card-cta sh-btn-{{ $section->image_zoom_hover ? 'zoom' : '' }}" style="{{ $buttonStyle($card) }}">
                                    {{ $card->cta_text }}
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @elseif ($layout === 'split')
            @php
                $featured = $cards->firstWhere('is_featured', true) ?? $cards->first();
                $rest = $cards->reject(fn ($c) => $featured && $c->id === $featured->id);
                $featuredFirst = ($section->split_featured_position ?? 'left') === 'left';
            @endphp
            <div class="sh-split" style="gap:{{ $section->card_spacing ?? 24 }}px;flex-direction:{{ $featuredFirst ? 'row' : 'row-reverse' }};">
                @if ($featured)
                    <div class="sh-split-featured sh-card sh-hover-{{ $section->hover_animation ?? 'lift' }} sh-anim-{{ $featured->animation_type ?? 'fade-up' }} {{ $section->card_shadow ? 'sh-shadow' : '' }}"
                         style="{{ $renderCardStyle($featured) }}animation-delay:{{ $featured->animation_delay ?? 0 }}ms;">
                        @if ($overlayStyle($featured))
                            <div class="sh-card-overlay" style="{{ $overlayStyle($featured) }}"></div>
                        @endif
                        <div class="sh-card-inner">
                            @if ($featured->card_type === 'icon' && $featured->icon)
                                <div class="sh-icon-wrap sh-icon-wrap-lg" style="color:{{ $featured->icon_color ?: '#2563eb' }};background-color:{{ $featured->icon_bg_color ?: '#eff6ff' }};">
                                    <i class="{{ $featured->icon }}"></i>
                                </div>
                            @endif
                            @if ($featured->heading)
                                <h3 class="sh-card-heading sh-card-heading-lg">{{ $featured->heading }}</h3>
                            @endif
                            @if ($featured->subheading)
                                <p class="sh-card-subheading">{{ $featured->subheading }}</p>
                            @endif
                            @if ($featured->cta_text)
                                <a href="{{ $featured->cta_link ?: '#' }}" class="sh-card-cta" style="{{ $buttonStyle($featured) }}">{{ $featured->cta_text }}</a>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="sh-split-stack" style="gap:{{ $section->card_spacing ?? 24 }}px;">
                    @foreach ($rest as $card)
                        <div class="sh-card sh-hover-{{ $section->hover_animation ?? 'lift' }} sh-anim-{{ $card->animation_type ?? 'fade-up' }} {{ $section->card_shadow ? 'sh-shadow' : '' }}"
                             style="{{ $renderCardStyle($card) }}animation-delay:{{ $card->animation_delay ?? 0 }}ms;">
                            @if ($overlayStyle($card))
                                <div class="sh-card-overlay" style="{{ $overlayStyle($card) }}"></div>
                            @endif
                            <div class="sh-card-inner sh-card-inner-row">
                                @if ($card->card_type === 'icon' && $card->icon)
                                    <div class="sh-icon-wrap" style="color:{{ $card->icon_color ?: '#2563eb' }};background-color:{{ $card->icon_bg_color ?: '#eff6ff' }};">
                                        <i class="{{ $card->icon }}"></i>
                                    </div>
                                @endif
                                <div>
                                    @if ($card->heading)
                                        <h3 class="sh-card-heading">{{ $card->heading }}</h3>
                                    @endif
                                    @if ($card->subheading)
                                        <p class="sh-card-subheading">{{ $card->subheading }}</p>
                                    @endif
                                    @if ($card->cta_text)
                                        <a href="{{ $card->cta_link ?: '#' }}" class="sh-card-cta sh-card-cta-sm" style="{{ $buttonStyle($card) }}">{{ $card->cta_text }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="sh-cardview" style="--sh-cardview-cols:{{ $section->card_view_columns ?? 3 }};gap:{{ $section->card_spacing ?? 24 }}px;">
                @foreach ($cards as $card)
                    <div class="sh-card sh-cardview-item sh-hover-{{ $section->hover_animation ?? 'lift' }} sh-anim-{{ $card->animation_type ?? 'fade-up' }} {{ $section->card_shadow ? 'sh-shadow' : '' }} {{ $section->hover_shadow ? 'sh-hover-shadow' : '' }}"
                         style="{{ $renderCardStyle($card) }}animation-delay:{{ $card->animation_delay ?? 0 }}ms;">
                        @if ($overlayStyle($card))
                            <div class="sh-card-overlay" style="{{ $overlayStyle($card) }}"></div>
                        @endif
                        <div class="sh-card-inner">
                            @if ($card->card_type === 'icon' && $card->icon)
                                <div class="sh-icon-wrap" style="color:{{ $card->icon_color ?: '#2563eb' }};background-color:{{ $card->icon_bg_color ?: '#eff6ff' }};">
                                    <i class="{{ $card->icon }}"></i>
                                </div>
                            @endif
                            @if ($card->heading)
                                <h3 class="sh-card-heading">{{ $card->heading }}</h3>
                            @endif
                            @if ($card->subheading)
                                <p class="sh-card-subheading">{{ $card->subheading }}</p>
                            @endif
                            @if ($card->cta_text)
                                <a href="{{ $card->cta_link ?: '#' }}" class="sh-card-cta" style="{{ $buttonStyle($card) }}">{{ $card->cta_text }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

<style>
    .sh-section { position: relative; overflow: hidden; }
    .sh-container { position: relative; z-index: 1; max-width: 1200px; margin: 0 auto; padding: 0 24px; }
    .sh-header { max-width: 720px; margin: 0 auto 48px; }
    .sh-header[style*="text-align:left"], .sh-header[style*="text-align:right"] { margin-left: 0; margin-right: 0; }
    .sh-badge { display: inline-block; padding: 6px 16px; border-radius: 999px; background: rgba(37,99,235,.1); color: #2563eb; font-size: .78rem; font-weight: 600; letter-spacing: .04em; text-transform: uppercase; margin-bottom: 16px; }
    .sh-heading { font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 800; margin: 0 0 12px; line-height: 1.25; }
    .sh-subheading { font-size: 1rem; color: #6b7280; line-height: 1.6; margin: 0; }
    .sh-subheading p { margin: 0 0 12px; }
    .sh-subheading p:last-child { margin-bottom: 0; }
    .sh-subheading-list { margin: 0 0 12px; padding-left: 1.2em; text-align: left; }
    .sh-subheading-list:last-child { margin-bottom: 0; }
    .sh-subheading-list li { margin-bottom: 6px; }
    .sh-section-cta { margin-top: 20px; border-radius: 8px; background-color: #2563eb; color: #ffffff; align-self: center; }

    .sh-grid { display: grid; grid-template-columns: repeat(var(--sh-cols-desktop, 3), minmax(0, 1fr)); gap: var(--sh-gap, 24px); }
    @media (max-width: 1024px) { .sh-grid { grid-template-columns: repeat(var(--sh-cols-tablet, 2), minmax(0, 1fr)); } }
    @media (max-width: 640px) { .sh-grid { grid-template-columns: repeat(var(--sh-cols-mobile, 1), minmax(0, 1fr)); } }

    .sh-card { position: relative; height: var(--sh-card-height, auto); transition: transform .35s ease, box-shadow .35s ease; }
    .sh-card-overlay { position: absolute; inset: 0; border-radius: inherit; pointer-events: none; }
    .sh-card-inner { position: relative; z-index: 1; padding: 32px; display: flex; flex-direction: column; height: 100%; }
    .sh-card-inner-row { flex-direction: row; align-items: flex-start; gap: 16px; }
    .sh-shadow { box-shadow: 0 6px 24px rgba(15, 23, 42, .08); }
    .sh-hover-shadow:hover { box-shadow: 0 16px 40px rgba(15, 23, 42, .16); }

    .sh-icon-wrap { width: 52px; height: 52px; border-radius: 14px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; margin-bottom: 18px; }
    .sh-icon-wrap-lg { width: 72px; height: 72px; font-size: 1.9rem; border-radius: 18px; }
    .sh-card-heading { font-size: 1.15rem; font-weight: 700; margin: 0 0 8px; }
    .sh-card-heading-lg { font-size: 1.6rem; }
    .sh-card-subheading { font-size: .92rem; color: #6b7280; line-height: 1.55; margin: 0 0 16px; flex: 1; }
    .sh-card-cta { display: inline-flex; align-items: center; justify-content: center; padding: 10px 22px; font-size: .88rem; font-weight: 600; text-decoration: none; transition: background-color .25s ease, color .25s ease, transform .25s ease; align-self: flex-start; }
    .sh-card-cta-sm { padding: 8px 16px; font-size: .82rem; }

    .sh-hover-lift:hover { transform: translateY(-8px); }
    .sh-hover-zoom:hover { transform: scale(1.03); }
    .sh-hover-tilt:hover { transform: rotate(-1deg) translateY(-4px); }
    .sh-hover-glow:hover { box-shadow: 0 0 32px rgba(37, 99, 235, .35); }

    .sh-split { display: flex; align-items: stretch; }
    .sh-split-featured { flex: 1.3; min-height: 420px; }
    .sh-split-stack { flex: 1; display: flex; flex-direction: column; }
    @media (max-width: 900px) { .sh-split { flex-direction: column !important; } .sh-split-featured { min-height: 280px; } }

    .sh-cardview { display: grid; grid-template-columns: repeat(var(--sh-cardview-cols, 3), minmax(0, 1fr)); }
    @media (max-width: 1024px) { .sh-cardview { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
    @media (max-width: 640px) { .sh-cardview { grid-template-columns: 1fr; } }

    .sh-anim-fade-up, .sh-anim-fade-left, .sh-anim-fade-right, .sh-anim-zoom-in, .sh-anim-scale, .sh-anim-slide-up {
        opacity: 0; animation: sh-fade-up .7s ease forwards; animation-play-state: paused;
    }
    .sh-anim-fade-left { animation-name: sh-fade-left; }
    .sh-anim-fade-right { animation-name: sh-fade-right; }
    .sh-anim-zoom-in { animation-name: sh-zoom-in; }
    .sh-anim-scale { animation-name: sh-scale; }
    .sh-anim-slide-up { animation-name: sh-slide-up; }
    .sh-in-view { animation-play-state: running !important; }

    @keyframes sh-fade-up { from { opacity: 0; transform: translateY(28px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes sh-fade-left { from { opacity: 0; transform: translateX(-28px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes sh-fade-right { from { opacity: 0; transform: translateX(28px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes sh-zoom-in { from { opacity: 0; transform: scale(.85); } to { opacity: 1; transform: scale(1); } }
    @keyframes sh-scale { from { opacity: 0; transform: scale(.92); } to { opacity: 1; transform: scale(1); } }
    @keyframes sh-slide-up { from { opacity: 0; transform: translateY(48px); } to { opacity: 1; transform: translateY(0); } }
</style>

<script>
    (function () {
        const items = document.querySelectorAll('.sh-section [class*="sh-anim-"]');
        if (!('IntersectionObserver' in window) || !items.length) {
            items.forEach(el => el.classList.add('sh-in-view'));
            return;
        }
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('sh-in-view');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        items.forEach(el => observer.observe(el));
    })();
</script>
