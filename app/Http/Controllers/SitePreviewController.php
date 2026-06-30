<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use App\Models\AdmissionProcessSection;
use App\Models\CourseSection;
use App\Models\LandingSection;
use App\Models\Menu;
use App\Models\MenuButton;
use App\Models\MenuSetting;
use App\Models\PlacementSection;
use App\Models\Ribbion;
use App\Models\SectionHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SitePreviewController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $user = Auth::user();

        $menus = Menu::with('items.children')->where('user_id', $userId)->orderBy('order')->get();
        $menuButtons = MenuButton::where('user_id', $userId)->orderBy('order')->get();
        $menuSetting = MenuSetting::where('user_id', $userId)->first();

        $headerPreview = [
            'logoUrl' => $user->logo ? asset($user->logo) : asset('logo.png'),
            'logoPosition' => $menuSetting?->logo_position ?? 'left',
            'logoSize' => $menuSetting?->logo_size ?? 40,
            'menus' => $menus->map(fn ($menu) => [
                'name' => $menu->name,
                'type' => $menu->type,
                'items' => $menu->items->map(fn ($item) => [
                    'label' => $item->label,
                    'link' => $item->link ?? '',
                    'is_external' => $item->is_external ?? false,
                    'submenu' => $item->children->map(fn ($child) => [
                        'label' => $child->label,
                        'link' => $child->link ?? '',
                        'is_external' => $child->is_external ?? false,
                    ])->values(),
                ])->values(),
            ])->values(),
            'buttons' => $menuButtons->map(fn ($button) => [
                'label' => $button->label,
                'link' => $button->link ?? '',
                'is_external' => $button->is_external ?? false,
            ])->values(),
        ];

        $landingSection = LandingSection::with(['buttons', 'slides.buttons'])
            ->where('user_id', $userId)
            ->first();

        $slideToPreview = fn ($slide, $buttons) => [
            'heading' => $slide->heading ?? '',
            'subheading' => $slide->subheading ?? '',
            'position' => $slide->position ?? 'left',
            'buttons' => $buttons->map(fn ($b) => ['label' => $b->label, 'link' => $b->link ?? ''])->values(),
            'background' => [
                'type' => $slide->background_type ?? 'color',
                'color' => $slide->background_color ?? '#2563eb',
                'gradient' => $slide->background_gradient ?? 'solid',
                'fade_opacity' => $slide->background_fade_opacity ?? 50,
            ],
            'imageUrl' => $slide->background_image ? Storage::url($slide->background_image) : null,
        ];

        $landingPreview = [
            'screen_type' => $landingSection?->screen_type ?? 'single',
            'slides' => $landingSection
                ? ($landingSection->screen_type === 'single'
                    ? [$slideToPreview($landingSection, $landingSection->buttons)]
                    : $landingSection->slides->map(fn ($slide) => $slideToPreview($slide, $slide->buttons))->values())
                : [],
        ];

        $aboutSection = AboutSection::where('user_id', $userId)->first();
        $aboutPreview = [
            'badge' => $aboutSection?->badge ?? '',
            'heading' => $aboutSection?->heading ?? '',
            'description' => $aboutSection?->subheading ?? '',
            'buttonLabel' => $aboutSection?->button_label ?? '',
            'buttonLink' => $aboutSection?->aboutBtnLink ?? '',
            'image' => $aboutSection?->image1 ? Storage::url($aboutSection->image1) : null,
        ];

        $ribbon = Ribbion::with('notices')->where('user_id', $userId)->first();
        $ribbonPreview = [
            'enabled' => (bool) ($ribbon?->status ?? false),
            'backgroundColor' => $ribbon?->backgroundColor ?? '#2563eb',
            'textColor' => $ribbon?->textColor ?? '#ffffff',
            'ribbonPosition' => $ribbon?->ribbonPosition ?? 'top',
            'cssPosition' => $ribbon?->position ?? 'fixed',
            'showClose' => $ribbon ? (bool) $ribbon->ribbonCloseBtnRadio : true,
            'isSlide' => ($ribbon?->ribbonAnimation ?? 'no') === 'yes',
            'sliderSpeed' => $ribbon?->sliderSpeed ?? 10,
            'notices' => $ribbon
                ? $ribbon->notices->map(fn ($n) => ['text' => $n->name, 'href' => $n->anchor_href])->values()
                : [],
        ];

        $sectionHeader = SectionHeader::with('cards')->where('user_id', $userId)->first();

        $courseSection = CourseSection::with('cards')->where('user_id', $userId)->first();

        $admissionProcessSection = AdmissionProcessSection::with('steps')->where('user_id', $userId)->first();

        $placementSection = PlacementSection::with('logos')->where('user_id', $userId)->first();

        return view('admin.site-preview', compact('headerPreview', 'landingPreview', 'aboutPreview', 'ribbonPreview', 'sectionHeader', 'courseSection', 'admissionProcessSection', 'placementSection'));
    }
}
