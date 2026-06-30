<?php

namespace App\Http\Controllers;

use App\Models\AdmissionProcessSection;
use App\Models\AdmissionProcessStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdmissionProcessController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $section = AdmissionProcessSection::with('steps')->where('user_id', $userId)->first();

        $initialState = [
            'badge' => $section?->badge ?? '',
            'heading' => $section?->heading ?? '',
            'subheading' => $section?->subheading ?? '',
            'cta_text' => $section?->cta_text ?? '',
            'cta_link' => $section?->cta_link ?? '',

            'steps' => $section
                ? $section->steps->map(fn ($s) => [
                    'icon' => $s->icon ?? '',
                    'heading' => $s->heading ?? '',
                    'subheading' => $s->subheading ?? '',
                ])->values()
                : [],
        ];

        return view('admin.admission-process', compact('initialState'));
    }

    public function store(Request $request)
    {
        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'badge' => 'nullable|string|max:100',
            'heading' => 'nullable|string|max:255',
            'subheading' => 'nullable|string|max:2000',
            'cta_text' => 'nullable|string|max:100',
            'cta_link' => 'nullable|string|max:255',

            'steps' => 'array',
            'steps.*.icon' => 'nullable|string|max:100',
            'steps.*.heading' => 'nullable|string|max:255',
            'steps.*.subheading' => 'nullable|string|max:1000',
        ])->validate();

        $userId = Auth::id();

        DB::transaction(function () use ($validated, $userId) {
            $section = AdmissionProcessSection::updateOrCreate(
                ['user_id' => $userId],
                [
                    'badge' => $validated['badge'] ?? null,
                    'heading' => $validated['heading'] ?? null,
                    'subheading' => $validated['subheading'] ?? null,
                    'cta_text' => $validated['cta_text'] ?? null,
                    'cta_link' => $validated['cta_link'] ?? null,
                ]
            );

            AdmissionProcessStep::where('admission_process_section_id', $section->id)->delete();

            foreach ($validated['steps'] ?? [] as $stepIndex => $stepData) {
                AdmissionProcessStep::create([
                    'admission_process_section_id' => $section->id,
                    'order' => $stepIndex,
                    'icon' => $stepData['icon'] ?? null,
                    'heading' => $stepData['heading'] ?? null,
                    'subheading' => $stepData['subheading'] ?? null,
                ]);
            }
        });

        return redirect()->route('admin.admission-process')->with('success', 'Admission process saved successfully.');
    }
}
