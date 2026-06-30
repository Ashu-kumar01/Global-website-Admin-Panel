<?php

namespace App\Http\Controllers;

use App\Models\Ribbion;
use App\Models\RibbonNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RibbonController extends Controller
{
    public function index()
    {
        $ribbon = Ribbion::with('notices')->where('user_id', Auth::id())->first();

        return view('admin.ribbon', compact('ribbon'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'backgroundColor' => 'nullable|string',
            'textColor' => 'nullable|string',
            'ribbonPosition' => 'nullable|in:top,bottom',
            'position' => 'nullable|in:fixed,absolute',
            'ribbonCloseBtnRadio' => 'nullable|in:yes,no',
            'ribbonAnimation' => 'nullable|in:yes,no',
            'sliderSpeed' => 'nullable|integer',
            'notices' => 'nullable|array',
            'notices.*.name' => 'nullable|string|max:300',
            'notices.*.link' => 'nullable|url',
            'notices.*.file' => 'nullable|file|max:5120',
            'notices.*.existing_file' => 'nullable|string',
            'notices.*.open_with' => 'nullable|in:link,file',
        ]);

        $userId = Auth::id();
        $ribbon = Ribbion::where('user_id', $userId)->first() ?? new Ribbion();
        $ribbon->fill([
            'user_id' => $userId,
            'backgroundColor' => $validated['backgroundColor'] ?? null,
            'textColor' => $validated['textColor'] ?? null,
            'ribbonPosition' => $validated['ribbonPosition'] ?? null,
            'position' => $validated['position'] ?? null,
            'ribbonCloseBtnRadio' => ($validated['ribbonCloseBtnRadio'] ?? 'no') === 'yes',
            'ribbonAnimation' => $validated['ribbonAnimation'] ?? 'no',
            'sliderSpeed' => $validated['sliderSpeed'] ?? 0,
            'status' => true,
        ]);
        $ribbon->save();

        $ribbon->notices()->delete();

        foreach ($request->input('notices', []) as $index => $notice) {
            if (empty($notice['name'])) {
                continue;
            }

            $filePath = $notice['existing_file'] ?? null;
            if ($request->hasFile("notices.$index.file")) {
                $filePath = $request->file("notices.$index.file")->store('ribbon-notices', 'public');
            }

            RibbonNotice::create([
                'ribbion_id' => $ribbon->id,
                'name' => $notice['name'],
                'link' => $notice['link'] ?? null,
                'file' => $filePath,
                'link_preference' => $notice['open_with'] ?? null,
            ]);
        }

        return redirect()->route('admin.ribbon')->with('success', 'Ribbon updated successfully.');
    }
}
