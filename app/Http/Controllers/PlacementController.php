<?php

namespace App\Http\Controllers;

use App\Models\PlacementLogo;
use App\Models\PlacementSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PlacementController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $section = PlacementSection::with('logos')->where('user_id', $userId)->first();

        $initialState = [
            'badge' => $section?->badge ?? '',
            'heading' => $section?->heading ?? '',
            'subheading' => $section?->subheading ?? '',
            'highest_package' => $section?->highest_package ?? '',
            'average_package' => $section?->average_package ?? '',
            'total_recruiters' => $section?->total_recruiters ?? '',
            'design_type' => $section?->design_type ?? 'grid',

            'logos' => $section
                ? $section->logos->map(fn ($l) => [
                    'company_name' => $l->company_name ?? '',
                    'image' => $l->image ? Storage::url($l->image) : null,
                    'existing_image' => $l->image,
                ])->values()
                : [],
        ];

        return view('admin.placement', compact('initialState'));
    }

    public function store(Request $request)
    {
        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'badge' => 'nullable|string|max:100',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:2000',
            'highest_package' => 'nullable|string|max:100',
            'average_package' => 'nullable|string|max:100',
            'total_recruiters' => 'nullable|string|max:100',
            'design_type' => 'required|in:grid,marquee',

            'logos' => 'array',
            'logos.*.company_name' => 'nullable|string|max:150',
            'logos.*.existing_image' => 'nullable|string',
        ])->validate();

        $userId = Auth::id();

        DB::transaction(function () use ($validated, $request, $userId) {
            $section = PlacementSection::updateOrCreate(
                ['user_id' => $userId],
                [
                    'badge' => $validated['badge'] ?? null,
                    'heading' => $validated['heading'] ?? null,
                    'subheading' => $validated['subheading'] ?? null,
                    'highest_package' => $validated['highest_package'] ?? null,
                    'average_package' => $validated['average_package'] ?? null,
                    'total_recruiters' => $validated['total_recruiters'] ?? null,
                    'design_type' => $validated['design_type'],
                ]
            );

            PlacementLogo::where('placement_section_id', $section->id)->delete();

            foreach ($validated['logos'] ?? [] as $logoIndex => $logoData) {
                $logoImagePath = $logoData['existing_image'] ?? null;
                if ($request->hasFile("logos.$logoIndex.image")) {
                    $logoImagePath = $request->file("logos.$logoIndex.image")->store('placement-logos', 'public');
                }

                PlacementLogo::create([
                    'placement_section_id' => $section->id,
                    'order' => $logoIndex,
                    'company_name' => $logoData['company_name'] ?? null,
                    'image' => $logoImagePath,
                ]);
            }
        });

        return redirect()->route('admin.placement')->with('success', 'Placement section saved successfully.');
    }
}
