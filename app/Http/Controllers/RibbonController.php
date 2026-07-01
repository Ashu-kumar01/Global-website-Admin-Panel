<?php

namespace App\Http\Controllers;

use App\Models\Ribbion;
use App\Models\RibbonNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RibbonController extends Controller
{
    private const MAX_RIBBONS = 3;

    public function index()
    {
        $userId = Auth::id();

        $ribbons = Ribbion::with('notices')->where('user_id', $userId)->orderBy('slot')->get();

        $initialState = [
            'ribbons' => $ribbons->map(fn ($r) => [
                'backgroundColor' => $r->backgroundColor ?? '#2563eb',
                'textColor' => $r->textColor ?? '#ffffff',
                'fontFamily' => $r->fontFamily ?? '',
                'fontSize' => $r->fontSize ?? 14,
                'fontWeight' => $r->fontWeight ?? '600',
                'ribbonHeight' => $r->ribbonHeight ?? 44,
                'ribbonPosition' => $r->ribbonPosition ?? 'top',
                'position' => $r->position ?? 'fixed',
                'ribbonCloseBtnRadio' => $r->ribbonCloseBtnRadio ? 'yes' : 'no',
                'ribbonAnimation' => $r->ribbonAnimation ?? 'no',
                'sliderSpeed' => $r->sliderSpeed ?? 10,
                'notices' => $r->notices->map(fn ($n) => [
                    'name' => $n->name ?? '',
                    'link' => $n->link ?? '',
                    'open_with' => $n->link_preference ?? 'link',
                    'existing_file' => $n->file,
                    'file_url' => $n->file_url,
                ])->values(),
            ])->values(),
            'max_ribbons' => self::MAX_RIBBONS,
        ];

        return view('admin.ribbon', compact('initialState'));
    }

    public function store(Request $request)
    {
        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'ribbons' => 'array|max:' . self::MAX_RIBBONS,
            'ribbons.*.backgroundColor' => 'nullable|string|max:30',
            'ribbons.*.textColor' => 'nullable|string|max:30',
            'ribbons.*.fontFamily' => 'nullable|string|max:100',
            'ribbons.*.fontSize' => 'nullable|integer|min:8|max:60',
            'ribbons.*.fontWeight' => 'nullable|string|max:10',
            'ribbons.*.ribbonHeight' => 'nullable|integer|min:20|max:200',
            'ribbons.*.ribbonPosition' => 'nullable|in:top,bottom',
            'ribbons.*.position' => 'nullable|in:fixed,absolute',
            'ribbons.*.ribbonCloseBtnRadio' => 'nullable|in:yes,no',
            'ribbons.*.ribbonAnimation' => 'nullable|in:yes,no',
            'ribbons.*.sliderSpeed' => 'nullable|integer|min:2|max:60',
            'ribbons.*.notices' => 'array',
            'ribbons.*.notices.*.name' => 'nullable|string|max:300',
            'ribbons.*.notices.*.link' => 'nullable|string|max:500',
            'ribbons.*.notices.*.open_with' => 'nullable|in:link,file',
            'ribbons.*.notices.*.existing_file' => 'nullable|string',
        ])->validate();

        $userId = Auth::id();

        DB::transaction(function () use ($validated, $request, $userId) {
            Ribbion::where('user_id', $userId)->delete();

            foreach ($validated['ribbons'] ?? [] as $ribbonIndex => $ribbonData) {
                $ribbon = Ribbion::create([
                    'user_id' => $userId,
                    'slot' => $ribbonIndex + 1,
                    'backgroundColor' => $ribbonData['backgroundColor'] ?? '#2563eb',
                    'textColor' => $ribbonData['textColor'] ?? '#ffffff',
                    'fontFamily' => $ribbonData['fontFamily'] ?? null,
                    'fontSize' => $ribbonData['fontSize'] ?? 14,
                    'fontWeight' => $ribbonData['fontWeight'] ?? '600',
                    'ribbonHeight' => $ribbonData['ribbonHeight'] ?? 44,
                    'ribbonPosition' => $ribbonData['ribbonPosition'] ?? 'top',
                    'position' => $ribbonData['position'] ?? 'fixed',
                    'ribbonCloseBtnRadio' => ($ribbonData['ribbonCloseBtnRadio'] ?? 'no') === 'yes',
                    'ribbonAnimation' => $ribbonData['ribbonAnimation'] ?? 'no',
                    'sliderSpeed' => $ribbonData['sliderSpeed'] ?? 10,
                    'status' => true,
                ]);

                foreach ($ribbonData['notices'] ?? [] as $noticeIndex => $noticeData) {
                    if (empty($noticeData['name'])) {
                        continue;
                    }

                    $filePath = $noticeData['existing_file'] ?? null;
                    if ($request->hasFile("ribbons.$ribbonIndex.notices.$noticeIndex.file")) {
                        $filePath = $request->file("ribbons.$ribbonIndex.notices.$noticeIndex.file")->store('ribbon-notices', 'public');
                    }

                    RibbonNotice::create([
                        'ribbion_id' => $ribbon->id,
                        'name' => $noticeData['name'],
                        'link' => $noticeData['link'] ?? null,
                        'file' => $filePath,
                        'link_preference' => $noticeData['open_with'] ?? null,
                    ]);
                }
            }
        });

        return redirect()->route('admin.ribbon')->with('success', 'Ribbons updated successfully.');
    }
}
