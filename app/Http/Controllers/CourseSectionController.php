<?php

namespace App\Http\Controllers;

use App\Models\CourseSection;
use App\Models\CourseSectionCard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseSectionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $section = CourseSection::with('cards')->where('user_id', $userId)->first();

        $initialState = [
            'heading' => $section?->heading ?? '',
            'subheading' => $section?->subheading ?? '',
            'design_type' => $section?->design_type ?? 'grid',
            'image_position' => $section?->image_position ?? 'left',
            'image' => $section?->image ? Storage::url($section->image) : null,
            'existing_image' => $section?->image,

            'cards' => $section
                ? $section->cards->map(fn ($c) => [
                    'heading' => $c->heading ?? '',
                    'subheading' => $c->subheading ?? '',
                    'short_description' => $c->short_description ?? '',
                    'course_type' => $c->course_type ?? '',
                    'duration' => $c->duration ?? '',
                    'badge' => $c->badge ?? '',
                    'explore_text' => $c->explore_text ?? '',
                    'explore_link' => $c->explore_link ?? '',
                    'background_color' => $c->background_color ?? '#ffffff',
                    'image' => $c->image ? Storage::url($c->image) : null,
                    'existing_image' => $c->image,
                ])->values()
                : [],
        ];

        return view('admin.course-section', compact('initialState'));
    }

    public function store(Request $request)
    {
        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:2000',
            'design_type' => 'required|in:grid,image,slider',
            'image_position' => 'nullable|in:left,right',
            'existing_image' => 'nullable|string',

            'cards' => 'array',
            'cards.*.heading' => 'nullable|string|max:255',
            'cards.*.subheading' => 'nullable|string|max:500',
            'cards.*.short_description' => 'nullable|string|max:1000',
            'cards.*.course_type' => 'nullable|in:full_time,part_time',
            'cards.*.duration' => 'nullable|string|max:100',
            'cards.*.badge' => 'nullable|string|max:100',
            'cards.*.explore_text' => 'nullable|string|max:100',
            'cards.*.explore_link' => 'nullable|string|max:255',
            'cards.*.background_color' => 'nullable|string|max:30',
            'cards.*.existing_image' => 'nullable|string',
        ])->validate();

        $userId = Auth::id();

        DB::transaction(function () use ($validated, $request, $userId) {
            $sectionImagePath = $validated['existing_image'] ?? null;
            if ($request->hasFile('image')) {
                $sectionImagePath = $request->file('image')->store('course-sections', 'public');
            }

            $section = CourseSection::updateOrCreate(
                ['user_id' => $userId],
                [
                    'heading' => $validated['heading'] ?? null,
                    'subheading' => $validated['subheading'] ?? null,
                    'design_type' => $validated['design_type'],
                    'image_position' => $validated['image_position'] ?? 'left',
                    'image' => $sectionImagePath,
                ]
            );

            CourseSectionCard::where('course_section_id', $section->id)->delete();

            foreach ($validated['cards'] ?? [] as $cardIndex => $cardData) {
                $cardImagePath = $cardData['existing_image'] ?? null;
                if ($request->hasFile("cards.$cardIndex.image")) {
                    $cardImagePath = $request->file("cards.$cardIndex.image")->store('course-sections', 'public');
                }

                CourseSectionCard::create([
                    'course_section_id' => $section->id,
                    'order' => $cardIndex,
                    'heading' => $cardData['heading'] ?? null,
                    'subheading' => $cardData['subheading'] ?? null,
                    'short_description' => $cardData['short_description'] ?? null,
                    'course_type' => ($cardData['course_type'] ?? null) ?: null,
                    'duration' => $cardData['duration'] ?? null,
                    'badge' => $cardData['badge'] ?? null,
                    'explore_text' => $cardData['explore_text'] ?? null,
                    'explore_link' => $cardData['explore_link'] ?? null,
                    'background_color' => $cardData['background_color'] ?? null,
                    'image' => $cardImagePath,
                ]);
                
            }
        });

        return redirect()->route('admin.courses')->with('success', 'Courses section saved successfully.');
    }
}
