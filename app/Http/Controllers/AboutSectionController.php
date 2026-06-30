<?php

namespace App\Http\Controllers;

use App\Models\AboutSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AboutSectionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $aboutSection = AboutSection::where('user_id', $userId)->first();

        return view('admin.about-section', compact('aboutSection'));
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'badge' => 'required|string|max:255',
            'heading' => 'required|string|max:255',
            'subheading' => 'required',
            'aboutPosition' => 'required|in:left,center,right',
            'button_label' => 'required|string|max:255',
            'aboutBtnLink' => 'required|url',
            'image1' => 'nullable|image|max:2048',
            'image2' => 'nullable|image|max:2048',
            'aboutImage1Position' => 'nullable|in:left,right,top,bottom',
            'aboutImage2Position' => 'nullable|in:left,right,top,bottom',
        ])->validate();

        $userId = Auth::id();

        return DB::transaction(function () use ($validated, $request, $userId) {
            $existing = AboutSection::where('user_id', $userId)->first();

            $image1 = $existing?->image1;
            $image2 = $existing?->image2;

            if ($request->hasFile('image1')) {
                $image1 = $request->file('image1')->store('about-sections', 'public');
            }

            if ($request->hasFile('image2')) {
                $image2 = $request->file('image2')->store('about-sections', 'public');
            }

            AboutSection::updateOrCreate(
                ['user_id' => $userId],
                [
                    'badge'               => $validated['badge'],
                    'heading'             => $validated['heading'],
                    'subheading'          => $validated['subheading'],
                    'aboutPosition'       => $validated['aboutPosition'],
                    'button_label'        => $validated['button_label'],
                    'aboutBtnLink'        => $validated['aboutBtnLink'],
                    'aboutImage1Position' => $validated['aboutImage1Position'] ?? null,
                    'aboutImage2Position' => $validated['aboutImage2Position'] ?? null,
                    'image1'              => $image1,
                    'image2'              => $image2,
                ]
            );

            return redirect()->route('admin.about-section')->with('success', 'About section saved successfully.');
        });
    }
}
