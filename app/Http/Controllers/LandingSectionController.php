<?php

namespace App\Http\Controllers;

use App\Models\LandingSection;
use App\Models\LandingSectionButton;
use App\Models\LandingSectionSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LandingSectionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $section = LandingSection::with(['buttons', 'slides.buttons'])
            ->where('user_id', $userId)
            ->first();

        $initialState = [
            'screen_type' => $section?->screen_type ?? 'single',
            'heading' => $section?->heading ?? '',
            'subheading' => $section?->subheading ?? '',
            'position' => $section?->position ?? 'left',
            'background' => [
                'type' => $section?->background_type ?? 'color',
                'color' => $section?->background_color ?? '#2563eb',
                'image' => $section?->background_image ? Storage::url($section->background_image) : null,
                'existing_image' => $section?->background_image,
                'gradient' => $section?->background_gradient ?? 'solid',
                'fade_opacity' => $section?->background_fade_opacity ?? 50,
            ],
            'buttons' => $section
                ? $section->buttons->map(fn ($b) => ['label' => $b->label, 'link' => $b->link ?? ''])->values()
                : [],
            'slides' => $section
                ? $section->slides->map(fn ($slide) => [
                    'heading' => $slide->heading ?? '',
                    'subheading' => $slide->subheading ?? '',
                    'position' => $slide->position ?? 'left',
                    'background' => [
                        'type' => $slide->background_type ?? 'color',
                        'color' => $slide->background_color ?? '#2563eb',
                        'image' => $slide->background_image ? Storage::url($slide->background_image) : null,
                        'existing_image' => $slide->background_image,
                        'gradient' => $slide->background_gradient ?? 'solid',
                        'fade_opacity' => $slide->background_fade_opacity ?? 50,
                    ],
                    'buttons' => $slide->buttons->map(fn ($b) => ['label' => $b->label, 'link' => $b->link ?? ''])->values(),
                ])->values()
                : [],
        ];

        return view('admin.landing-sections', compact('initialState'));
    }

    public function store(Request $request)
    {
        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'screen_type' => 'required|in:single,slider,scroll',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:255',
            'position' => 'required_if:screen_type,single|in:left,center,right',

            'background.type' => 'required_if:screen_type,single|in:color,image,image_fade',
            'background.color' => 'nullable|string|max:30',
            'background.gradient' => 'nullable|in:solid,top,bottom,left,right,diagonal,radial',
            'background.fade_opacity' => 'nullable|integer|min:0|max:100',
            'background.existing_image' => 'nullable|string',

            'buttons' => 'array',
            'buttons.*.label' => 'required|string|max:150',
            'buttons.*.link' => 'nullable|string|max:255',

            'slides' => 'array',
            'slides.*.heading' => 'nullable|string|max:255',
            'slides.*.subheading' => 'nullable|string|max:255',
            'slides.*.position' => 'required|in:left,center,right',
            'slides.*.background.type' => 'required|in:color,image,image_fade',
            'slides.*.background.color' => 'nullable|string|max:30',
            'slides.*.background.gradient' => 'nullable|in:solid,top,bottom,left,right,diagonal,radial',
            'slides.*.background.fade_opacity' => 'nullable|integer|min:0|max:100',
            'slides.*.background.existing_image' => 'nullable|string',
            'slides.*.buttons' => 'array',
            'slides.*.buttons.*.label' => 'required|string|max:150',
            'slides.*.buttons.*.link' => 'nullable|string|max:255',
        ])->validate();

        $userId = Auth::id();

        DB::transaction(function () use ($validated, $request, $userId) {
            $backgroundImagePath = $validated['background']['existing_image'] ?? null;
            if ($request->hasFile('background_image')) {
                $backgroundImagePath = $request->file('background_image')->store('landing-sections', 'public');
            }

            $section = LandingSection::updateOrCreate(
                ['user_id' => $userId],
                [
                    'screen_type' => $validated['screen_type'],
                    'heading' => $validated['heading'] ?? null,
                    'subheading' => $validated['subheading'] ?? null,
                    'position' => $validated['position'] ?? 'left',
                    'background_type' => $validated['background']['type'] ?? 'color',
                    'background_color' => $validated['background']['color'] ?? null,
                    'background_image' => $backgroundImagePath,
                    'background_gradient' => $validated['background']['gradient'] ?? 'solid',
                    'background_fade_opacity' => $validated['background']['fade_opacity'] ?? 50,
                ]
            );

            LandingSectionButton::where('landing_section_id', $section->id)->delete();
            foreach ($validated['buttons'] ?? [] as $buttonIndex => $buttonData) {
                LandingSectionButton::create([
                    'landing_section_id' => $section->id,
                    'label' => $buttonData['label'],
                    'link' => $buttonData['link'] ?? null,
                    'order' => $buttonIndex,
                ]);
            }

            LandingSectionSlide::where('landing_section_id', $section->id)->delete();
            foreach ($validated['slides'] ?? [] as $slideIndex => $slideData) {
                $slideImagePath = $slideData['background']['existing_image'] ?? null;
                if ($request->hasFile("slides.$slideIndex.background_image")) {
                    $slideImagePath = $request->file("slides.$slideIndex.background_image")->store('landing-sections', 'public');
                }

                $slide = LandingSectionSlide::create([
                    'landing_section_id' => $section->id,
                    'heading' => $slideData['heading'] ?? null,
                    'subheading' => $slideData['subheading'] ?? null,
                    'position' => $slideData['position'],
                    'background_type' => $slideData['background']['type'],
                    'background_color' => $slideData['background']['color'] ?? null,
                    'background_image' => $slideImagePath,
                    'background_gradient' => $slideData['background']['gradient'] ?? 'solid',
                    'background_fade_opacity' => $slideData['background']['fade_opacity'] ?? 50,
                    'order' => $slideIndex,
                ]);

                foreach ($slideData['buttons'] ?? [] as $buttonIndex => $buttonData) {
                    LandingSectionButton::create([
                        'landing_section_slide_id' => $slide->id,
                        'label' => $buttonData['label'],
                        'link' => $buttonData['link'] ?? null,
                        'order' => $buttonIndex,
                    ]);
                }
            }
        });

        return redirect()->route('admin.landing-sections')->with('success', 'Landing section saved successfully.');
    }
}