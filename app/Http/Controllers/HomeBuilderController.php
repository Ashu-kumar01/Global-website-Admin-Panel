<?php

namespace App\Http\Controllers;

use App\Models\HomePage;
use App\Models\HomePageSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class HomeBuilderController extends Controller
{
    private const MAX_SECTIONS = 10;

    private function catalog(): array
    {
        return config('home_sections', []);
    }

    private function homePageFor(int $userId): HomePage
    {
        return HomePage::firstOrCreate(['user_id' => $userId], ['status' => 'draft']);
    }

    private function isSectionConfigured(string $key, array $definition, HomePageSection $row): bool
    {
        if ($definition['type'] === 'real') {
            $model = $definition['model'];

            return $model::where('user_id', Auth::id())->exists();
        }

        return (bool) $row->is_configured;
    }

    private function previewTextFor(array $definition): ?string
    {
        if ($definition['type'] !== 'real') {
            return null;
        }

        $model = $definition['model'];
        $record = $model::where('user_id', Auth::id())->first();

        if (! $record) {
            return null;
        }

        return collect([$record->badge ?? null, $record->heading ?? null])->filter()->implode(' — ') ?: null;
    }

    private function buildState(HomePage $homePage): array
    {
        $catalog = $this->catalog();
        $rows = $homePage->sections;

        $sections = $rows->map(function (HomePageSection $row) use ($catalog) {
            $definition = $catalog[$row->section_key] ?? null;
            if (! $definition) {
                return null;
            }

            return [
                'key' => $row->section_key,
                'label' => $definition['label'],
                'description' => $definition['description'],
                'icon' => $definition['icon'],
                'type' => $definition['type'],
                'admin_route' => $definition['type'] === 'real' ? route($definition['admin_route']) : null,
                'priority' => $row->priority,
                'is_configured' => $this->isSectionConfigured($row->section_key, $definition, $row),
                'note' => $row->meta['note'] ?? '',
                'preview_text' => $this->previewTextFor($definition),
            ];
        })->filter()->values();

        return [
            'status' => $homePage->status,
            'last_saved_at' => optional($homePage->last_saved_at)->diffForHumans(),
            'published_at' => optional($homePage->published_at)->diffForHumans(),
            'max_sections' => self::MAX_SECTIONS,
            'catalog' => collect($catalog)->map(fn ($def, $key) => [
                'key' => $key,
                'label' => $def['label'],
                'description' => $def['description'],
                'icon' => $def['icon'],
                'type' => $def['type'],
            ])->values(),
            'sections' => $sections,
        ];
    }

    public function index()
    {
        $userId = Auth::id();
        $homePage = $this->homePageFor($userId);
        $initialState = $this->buildState($homePage);

        return view('admin.home-builder', compact('initialState'));
    }

    public function saveSelection(Request $request)
    {
        $catalog = $this->catalog();

        $validated = Validator::make($request->all(), [
            'sections' => 'required|array|max:' . self::MAX_SECTIONS,
            'sections.*.key' => 'required|string',
            'sections.*.priority' => 'required|integer|min:1',
        ])->validate();

        $keys = collect($validated['sections'])->pluck('key');
        if ($keys->diff(array_keys($catalog))->isNotEmpty()) {
            return response()->json(['message' => 'Unknown section selected.'], 422);
        }

        $priorities = collect($validated['sections'])->pluck('priority');
        if ($priorities->unique()->count() !== $priorities->count()) {
            return response()->json(['message' => 'Priority values must be unique.'], 422);
        }

        $homePage = $this->homePageFor(Auth::id());

        DB::transaction(function () use ($homePage, $validated) {
            $keepKeys = collect($validated['sections'])->pluck('key');

            HomePageSection::where('home_page_id', $homePage->id)
                ->whereNotIn('section_key', $keepKeys)
                ->delete();


                
            foreach ($validated['sections'] as $section) {
                HomePageSection::updateOrCreate(
                    ['home_page_id' => $homePage->id, 'section_key' => $section['key']],
                    ['priority' => $section['priority']]
                );
            }

            $homePage->update(['last_saved_at' => now()]);
        });

        $homePage->refresh()->load('sections');

        return response()->json($this->buildState($homePage));
    }

    public function configureSection(Request $request, string $key)
    {
        $catalog = $this->catalog();
        if (! isset($catalog[$key])) {
            return response()->json(['message' => 'Unknown section.'], 404);
        }

        $validated = $request->validate([
            'is_configured' => 'nullable|boolean',
            'note' => 'nullable|string|max:1000',
        ]);

        $homePage = $this->homePageFor(Auth::id());
        $row = HomePageSection::where('home_page_id', $homePage->id)->where('section_key', $key)->first();

        if (! $row) {
            return response()->json(['message' => 'Section is not selected for this home page.'], 422);
        }

        if ($catalog[$key]['type'] === 'placeholder') {
            $row->update([
                'is_configured' => $validated['is_configured'] ?? $row->is_configured,
                'meta' => ['note' => $validated['note'] ?? ($row->meta['note'] ?? '')],
            ]);
        }

        $homePage->update(['last_saved_at' => now()]);

        return response()->json($this->buildState($homePage->refresh()->load('sections')));
    }

    public function saveDraft()
    {
        $homePage = $this->homePageFor(Auth::id());
        $homePage->update(['last_saved_at' => now()]);

        return response()->json($this->buildState($homePage->load('sections')));
    }

    public function publish()
    {
        $homePage = $this->homePageFor(Auth::id())->load('sections');
        $catalog = $this->catalog();

        $unconfigured = $homePage->sections
            ->filter(fn (HomePageSection $row) => isset($catalog[$row->section_key])
                && ! $this->isSectionConfigured($row->section_key, $catalog[$row->section_key], $row))
            ->map(fn (HomePageSection $row) => $catalog[$row->section_key]['label']);

        if ($homePage->sections->isEmpty()) {
            return response()->json(['message' => 'Select at least one section before publishing.'], 422);
        }

        if ($unconfigured->isNotEmpty()) {
            return response()->json([
                'message' => 'Please configure all selected sections before publishing: ' . $unconfigured->implode(', '),
            ], 422);
        }

        $homePage->update(['status' => 'published', 'published_at' => now(), 'last_saved_at' => now()]);

        return response()->json($this->buildState($homePage->refresh()->load('sections')));
    }
}
