<?php

namespace App\Http\Controllers;

use App\Models\SectionHeader;
use App\Models\SectionHeaderCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WhyChooseUsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $section = SectionHeader::with('cards')->where('user_id', $userId)->first();

        $initialState = [
            'badge' => $section?->badge ?? '',
            'heading' => $section?->heading ?? '',
            'heading_accent_text' => $section?->heading_accent_text ?? '',
            'heading_accent_color' => $section?->heading_accent_color ?? '#2563eb',
            'heading_color' => $section?->heading_color ?? '',
            'subheading' => $section?->subheading ?? '',
            'subheading_color' => $section?->subheading_color ?? '',
            'cta_text' => $section?->cta_text ?? '',
            'cta_link' => $section?->cta_link ?? '',
            'layout_type' => $section?->layout_type ?? 'grid',

            'grid' => [
                'columns_desktop' => $section?->grid_columns_desktop ?? 3,
                'columns_tablet' => $section?->grid_columns_tablet ?? 2,
                'columns_mobile' => $section?->grid_columns_mobile ?? 1,
                'gap' => $section?->grid_gap ?? 24,
                'card_height' => $section?->card_height,
                'border_radius' => $section?->card_border_radius ?? 12,
                'shadow' => $section?->card_shadow ?? true,
                'hover_animation' => $section?->hover_animation ?? 'lift',
                'image_zoom_hover' => $section?->image_zoom_hover ?? true,
                'card_alignment' => $section?->card_alignment ?? 'center',
            ],
            'split' => [
                'featured_position' => $section?->split_featured_position ?? 'left',
            ],
            'card_view' => [
                'columns' => $section?->card_view_columns ?? 3,
            ],
            'design' => [
                'background_type' => $section?->section_background_type ?? 'color',
                'background_color' => $section?->section_background_color ?? '#ffffff',
                'background_image' => $section?->section_background_image ? Storage::url($section->section_background_image) : null,
                'existing_background_image' => $section?->section_background_image,
                'gradient_type' => $section?->section_gradient_type ?? 'linear',
                'gradient_color_1' => $section?->section_gradient_color_1 ?? '#2563eb',
                'gradient_color_2' => $section?->section_gradient_color_2 ?? '#1e3a8a',
                'gradient_angle' => $section?->section_gradient_angle ?? 135,
                'gradient_opacity' => $section?->section_gradient_opacity ?? 100,
                'padding_top' => $section?->padding_top ?? 80,
                'padding_bottom' => $section?->padding_bottom ?? 80,
                'hover_shadow' => $section?->hover_shadow ?? true,
                'card_spacing' => $section?->card_spacing ?? 24,
                'alignment' => $section?->alignment ?? 'center',
            ],

            'cards' => $section
                ? $section->cards->map(fn ($c) => [
                    'layout' => $c->layout,
                    'card_type' => $c->card_type,
                    'is_featured' => (bool) $c->is_featured,
                    'icon' => $c->icon ?? '',
                    'icon_color' => $c->icon_color ?? '#2563eb',
                    'icon_bg_color' => $c->icon_bg_color ?? '#eff6ff',
                    'heading' => $c->heading ?? '',
                    'subheading' => $c->subheading ?? '',
                    'background_type' => $c->background_type ?? 'color',
                    'background_color' => $c->background_color ?? '#ffffff',
                    'background_image' => $c->background_image ? Storage::url($c->background_image) : null,
                    'existing_background_image' => $c->background_image,
                    'image_overlay_color' => $c->image_overlay_color ?? '#000000',
                    'image_overlay_opacity' => $c->image_overlay_opacity ?? 40,
                    'image_border_radius' => $c->image_border_radius ?? 12,
                    'image_position' => $c->image_position ?? 'center',
                    'image_size' => $c->image_size ?? 'cover',
                    'gradient_type' => $c->gradient_type ?? 'linear',
                    'gradient_color_1' => $c->gradient_color_1 ?? '#2563eb',
                    'gradient_color_2' => $c->gradient_color_2 ?? '#1e3a8a',
                    'gradient_angle' => $c->gradient_angle ?? 135,
                    'overlay_color' => $c->overlay_color ?? '#000000',
                    'overlay_opacity' => $c->overlay_opacity ?? 0,
                    'cta_text' => $c->cta_text ?? '',
                    'cta_link' => $c->cta_link ?? '',
                    'button_style' => $c->button_style ?? 'filled',
                    'button_radius' => $c->button_radius ?? 8,
                    'button_bg_color' => $c->button_bg_color ?? '#2563eb',
                    'button_text_color' => $c->button_text_color ?? '#ffffff',
                    'button_hover_bg_color' => $c->button_hover_bg_color ?? '#1e40af',
                    'button_hover_text_color' => $c->button_hover_text_color ?? '#ffffff',
                    'hover_effect' => $c->hover_effect ?? 'lift',
                    'animation_type' => $c->animation_type ?? 'fade-up',
                    'animation_delay' => $c->animation_delay ?? 0,
                ])->values()
                : [],
        ];

        $pages = $this->availablePages();

        return view('admin.section-header', compact('initialState', 'pages'));
    }

    private function availablePages(): array
    {
        $excludedPrefixes = ['admin.', 'login', 'logout', 'register', 'password.', 'verification.', 'sanctum.'];

        return collect(Route::getRoutes())
            ->filter(function ($route) use ($excludedPrefixes) {
                $name = $route->getName();
                if (! $name || ! in_array('GET', $route->methods())) {
                    return false;
                }
                if (count($route->parameterNames()) > 0) {
                    return false;
                }
                foreach ($excludedPrefixes as $prefix) {
                    if (str_starts_with($name, $prefix)) {
                        return false;
                    }
                }
                return true;
            })
            ->map(fn ($route) => [
                'value' => $route->getName(),
                'label' => ucwords(str_replace(['.', '-', '_'], ' ', $route->getName())),
            ])
            ->unique('value')
            ->values()
            ->all();
    }

    public function store(Request $request)
    {
        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'badge' => 'nullable|string|max:100',
            'heading' => 'nullable|string|max:255',
            'heading_accent_text' => 'nullable|string|max:255',
            'heading_accent_color' => 'nullable|string|max:30',
            'heading_color' => 'nullable|string|max:30',
            'subheading' => 'nullable|string|max:2000',
            'subheading_color' => 'nullable|string|max:30',
            'cta_text' => 'nullable|string|max:100',
            'cta_link' => 'nullable|string|max:255',
            'layout_type' => 'required|in:grid,split,card',

            'grid.columns_desktop' => 'nullable|integer|min:1|max:6',
            'grid.columns_tablet' => 'nullable|integer|min:1|max:4',
            'grid.columns_mobile' => 'nullable|integer|min:1|max:2',
            'grid.gap' => 'nullable|integer|min:0|max:100',
            'grid.card_height' => 'nullable|integer|min:0|max:1000',
            'grid.border_radius' => 'nullable|integer|min:0|max:60',
            'grid.shadow' => 'nullable|boolean',
            'grid.hover_animation' => 'nullable|string|max:30',
            'grid.image_zoom_hover' => 'nullable|boolean',
            'grid.card_alignment' => 'nullable|in:left,center,right',

            'split.featured_position' => 'nullable|in:left,right',

            'card_view.columns' => 'nullable|integer|min:2|max:4',

            'design.background_type' => 'nullable|in:color,image,gradient',
            'design.background_color' => 'nullable|string|max:30',
            'design.existing_background_image' => 'nullable|string',
            'design.gradient_type' => 'nullable|in:linear,radial,diagonal,vertical,horizontal',
            'design.gradient_color_1' => 'nullable|string|max:30',
            'design.gradient_color_2' => 'nullable|string|max:30',
            'design.gradient_angle' => 'nullable|integer|min:0|max:360',
            'design.gradient_opacity' => 'nullable|integer|min:0|max:100',
            'design.padding_top' => 'nullable|integer|min:0|max:300',
            'design.padding_bottom' => 'nullable|integer|min:0|max:300',
            'design.hover_shadow' => 'nullable|boolean',
            'design.card_spacing' => 'nullable|integer|min:0|max:100',
            'design.alignment' => 'nullable|in:left,center,right',

            'cards' => 'array',
            'cards.*.layout' => 'required|in:grid,split,card',
            'cards.*.card_type' => 'required|in:icon,image,cta',
            'cards.*.is_featured' => 'nullable|boolean',
            'cards.*.icon' => 'nullable|string|max:100',
            'cards.*.icon_color' => 'nullable|string|max:30',
            'cards.*.icon_bg_color' => 'nullable|string|max:30',
            'cards.*.heading' => 'nullable|string|max:255',
            'cards.*.subheading' => 'nullable|string|max:500',
            'cards.*.background_type' => 'nullable|in:color,image,gradient',
            'cards.*.background_color' => 'nullable|string|max:30',
            'cards.*.existing_background_image' => 'nullable|string',
            'cards.*.image_overlay_color' => 'nullable|string|max:30',
            'cards.*.image_overlay_opacity' => 'nullable|integer|min:0|max:100',
            'cards.*.image_border_radius' => 'nullable|integer|min:0|max:60',
            'cards.*.image_position' => 'nullable|string|max:30',
            'cards.*.image_size' => 'nullable|string|max:30',
            'cards.*.gradient_type' => 'nullable|in:linear,radial,diagonal,vertical,horizontal',
            'cards.*.gradient_color_1' => 'nullable|string|max:30',
            'cards.*.gradient_color_2' => 'nullable|string|max:30',
            'cards.*.gradient_angle' => 'nullable|integer|min:0|max:360',
            'cards.*.overlay_color' => 'nullable|string|max:30',
            'cards.*.overlay_opacity' => 'nullable|integer|min:0|max:100',
            'cards.*.cta_text' => 'nullable|string|max:100',
            'cards.*.cta_link' => 'nullable|string|max:255',
            'cards.*.button_style' => 'nullable|in:filled,outline,ghost',
            'cards.*.button_radius' => 'nullable|integer|min:0|max:60',
            'cards.*.button_bg_color' => 'nullable|string|max:30',
            'cards.*.button_text_color' => 'nullable|string|max:30',
            'cards.*.button_hover_bg_color' => 'nullable|string|max:30',
            'cards.*.button_hover_text_color' => 'nullable|string|max:30',
            'cards.*.hover_effect' => 'nullable|string|max:30',
            'cards.*.animation_type' => 'nullable|string|max:30',
            'cards.*.animation_delay' => 'nullable|integer|min:0|max:5000',
        ])->validate();

        $userId = Auth::id();

        DB::transaction(function () use ($validated, $request, $userId) {
            $sectionBgImagePath = $validated['design']['existing_background_image'] ?? null;
            if ($request->hasFile('section_background_image')) {
                $sectionBgImagePath = $request->file('section_background_image')->store('section-headers', 'public');
            }

            $section = SectionHeader::updateOrCreate(
                ['user_id' => $userId],
                [
                    'badge' => $validated['badge'] ?? null,
                    'heading' => $validated['heading'] ?? null,
                    'heading_accent_text' => $validated['heading_accent_text'] ?? null,
                    'heading_accent_color' => $validated['heading_accent_color'] ?? '#2563eb',
                    'heading_color' => $validated['heading_color'] ?? null,
                    'subheading' => $validated['subheading'] ?? null,
                    'subheading_color' => $validated['subheading_color'] ?? null,
                    'cta_text' => $validated['cta_text'] ?? null,
                    'cta_link' => $validated['cta_link'] ?? null,
                    'layout_type' => $validated['layout_type'],

                    'grid_columns_desktop' => $validated['grid']['columns_desktop'] ?? 3,
                    'grid_columns_tablet' => $validated['grid']['columns_tablet'] ?? 2,
                    'grid_columns_mobile' => $validated['grid']['columns_mobile'] ?? 1,
                    'grid_gap' => $validated['grid']['gap'] ?? 24,
                    'card_height' => $validated['grid']['card_height'] ?? null,
                    'card_border_radius' => $validated['grid']['border_radius'] ?? 12,
                    'card_shadow' => $validated['grid']['shadow'] ?? true,
                    'hover_animation' => $validated['grid']['hover_animation'] ?? 'lift',
                    'image_zoom_hover' => $validated['grid']['image_zoom_hover'] ?? true,
                    'card_alignment' => $validated['grid']['card_alignment'] ?? 'center',

                    'split_featured_position' => $validated['split']['featured_position'] ?? 'left',

                    'card_view_columns' => $validated['card_view']['columns'] ?? 3,

                    'section_background_type' => $validated['design']['background_type'] ?? 'color',
                    'section_background_color' => $validated['design']['background_color'] ?? null,
                    'section_background_image' => $sectionBgImagePath,
                    'section_gradient_type' => $validated['design']['gradient_type'] ?? 'linear',
                    'section_gradient_color_1' => $validated['design']['gradient_color_1'] ?? null,
                    'section_gradient_color_2' => $validated['design']['gradient_color_2'] ?? null,
                    'section_gradient_angle' => $validated['design']['gradient_angle'] ?? 135,
                    'section_gradient_opacity' => $validated['design']['gradient_opacity'] ?? 100,
                    'padding_top' => $validated['design']['padding_top'] ?? 80,
                    'padding_bottom' => $validated['design']['padding_bottom'] ?? 80,
                    'hover_shadow' => $validated['design']['hover_shadow'] ?? true,
                    'card_spacing' => $validated['design']['card_spacing'] ?? 24,
                    'alignment' => $validated['design']['alignment'] ?? 'center',
                ]
            );

            SectionHeaderCard::where('section_header_id', $section->id)->delete();

            foreach ($validated['cards'] ?? [] as $cardIndex => $cardData) {
                $cardImagePath = $cardData['existing_background_image'] ?? null;
                if ($request->hasFile("cards.$cardIndex.background_image")) {
                    $cardImagePath = $request->file("cards.$cardIndex.background_image")->store('section-headers', 'public');
                }

                SectionHeaderCard::create([
                    'section_header_id' => $section->id,
                    'layout' => $cardData['layout'],
                    'card_type' => $cardData['card_type'],
                    'is_featured' => $cardData['is_featured'] ?? false,
                    'order' => $cardIndex,
                    'icon' => $cardData['icon'] ?? null,
                    'icon_color' => $cardData['icon_color'] ?? null,
                    'icon_bg_color' => $cardData['icon_bg_color'] ?? null,
                    'heading' => $cardData['heading'] ?? null,
                    'subheading' => $cardData['subheading'] ?? null,
                    'background_type' => $cardData['background_type'] ?? 'color',
                    'background_color' => $cardData['background_color'] ?? null,
                    'background_image' => $cardImagePath,
                    'image_overlay_color' => $cardData['image_overlay_color'] ?? null,
                    'image_overlay_opacity' => $cardData['image_overlay_opacity'] ?? 40,
                    'image_border_radius' => $cardData['image_border_radius'] ?? 12,
                    'image_position' => $cardData['image_position'] ?? 'center',
                    'image_size' => $cardData['image_size'] ?? 'cover',
                    'gradient_type' => $cardData['gradient_type'] ?? 'linear',
                    'gradient_color_1' => $cardData['gradient_color_1'] ?? null,
                    'gradient_color_2' => $cardData['gradient_color_2'] ?? null,
                    'gradient_angle' => $cardData['gradient_angle'] ?? 135,
                    'overlay_color' => $cardData['overlay_color'] ?? null,
                    'overlay_opacity' => $cardData['overlay_opacity'] ?? 0,
                    'cta_text' => $cardData['cta_text'] ?? null,
                    'cta_link' => $cardData['cta_link'] ?? null,
                    'button_style' => $cardData['button_style'] ?? 'filled',
                    'button_radius' => $cardData['button_radius'] ?? 8,
                    'button_bg_color' => $cardData['button_bg_color'] ?? null,
                    'button_text_color' => $cardData['button_text_color'] ?? null,
                    'button_hover_bg_color' => $cardData['button_hover_bg_color'] ?? null,
                    'button_hover_text_color' => $cardData['button_hover_text_color'] ?? null,
                    'hover_effect' => $cardData['hover_effect'] ?? 'lift',
                    'animation_type' => $cardData['animation_type'] ?? 'fade-up',
                    'animation_delay' => $cardData['animation_delay'] ?? 0,
                ]);
            }
        });

        return redirect()->route('admin.WhyChooseUs')->with('success', 'Section header saved successfully.');
    }
}
