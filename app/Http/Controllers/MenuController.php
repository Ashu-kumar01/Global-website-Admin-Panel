<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuButton;
use App\Models\MenuItem;
use App\Models\MenuSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $menus = Menu::with('items.children')->where('user_id', $userId)->orderBy('order')->get();
        $buttons = MenuButton::where('user_id', $userId)->orderBy('order')->get();
        $setting = MenuSetting::where('user_id', $userId)->first();

        $initialState = [
            'logoPosition' => $setting->logo_position ?? 'left',
            'logoSize' => $setting->logo_size ?? 40,
            'menus' => $menus->map(fn($menu) => [
                'name' => $menu->name,
                'type' => $menu->type,
                'items' => $menu->items->map(fn($item) => [
                    'label' => $item->label,
                    'link' => $item->link ?? '',
                    'is_external' => $item->is_external ?? false,
                    'submenu' => $item->children->map(fn($child) => [
                        'label' => $child->label,
                        'link' => $child->link ?? '',
                        'is_external' => $child->is_external ?? false,
                    ])->values(),
                ])->values(),
            ])->values(),
            'buttons' => $buttons->map(fn($button) => [
                'label' => $button->label,
                'link' => $button->link ?? '',
                'is_external' => $button->is_external ?? false,
            ])->values(),
        ];

        return view('admin.menu', compact('initialState'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:5120',
        ]);

        $payload = json_decode($request->input('payload', '{}'), true) ?: [];

        $validated = Validator::make($payload, [
            'menus' => 'array',
            'menus.*.name' => 'required|string|max:150',
            'menus.*.type' => 'required|in:mega,split,single',
            'menus.*.items' => 'array',
            'menus.*.items.*.label' => 'required|string|max:150',
            'menus.*.items.*.link' => 'nullable|string|max:255',
            'menus.*.items.*.is_external' => 'boolean',
            'menus.*.items.*.submenu' => 'array',
            'menus.*.items.*.submenu.*.label' => 'required|string|max:150',
            'menus.*.items.*.submenu.*.link' => 'nullable|string|max:255',
            'menus.*.items.*.submenu.*.is_external' => 'boolean',

            'buttons' => 'array',
            'buttons.*.label' => 'required|string|max:150',
            'buttons.*.link' => 'nullable|string|max:255',
            'buttons.*.is_external' => 'boolean',

            'logo_position' => 'required|in:left,center,right',
            'logo_size' => 'required|integer|min:16|max:200',
        ])->validate();

        if ($request->hasFile('logo')) {
            $uploadDir = public_path('upload');

            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            chmod($uploadDir, 0777);

            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move($uploadDir, $filename);
            chmod($uploadDir . DIRECTORY_SEPARATOR . $filename, 0777);

            $user = Auth::user();
            if ($user) {
                $user->update(['logo' => 'upload/' . $filename]);
            }
        }

        DB::transaction(function () use ($validated) {
            $userId = Auth::id();

            MenuItem::whereIn('menu_id', Menu::where('user_id', $userId)->pluck('id'))->delete();
            Menu::where('user_id', $userId)->delete();
            MenuButton::where('user_id', $userId)->delete();

            foreach ($validated['menus'] ?? [] as $menuIndex => $menuData) {
                $menu = Menu::create([
                    'user_id' => $userId,
                    'name' => $menuData['name'],
                    'type' => $menuData['type'],
                    'order' => $menuIndex,
                ]);

                foreach ($menuData['items'] ?? [] as $itemIndex => $itemData) {
                    $item = MenuItem::create([
                        'menu_id' => $menu->id,
                        'parent_id' => null,
                        'label' => $itemData['label'],
                        'link' => $itemData['link'] ?? null,
                        'is_external' => $itemData['is_external'] ?? false,
                        'order' => $itemIndex,
                    ]);

                    foreach ($itemData['submenu'] ?? [] as $subIndex => $subData) {
                        MenuItem::create([
                            'menu_id' => $menu->id,
                            'parent_id' => $item->id,
                            'label' => $subData['label'],
                            'link' => $subData['link'] ?? null,
                            'is_external' => $subData['is_external'] ?? false,
                            'order' => $subIndex,
                        ]);
                    }
                }
            }

            foreach ($validated['buttons'] ?? [] as $buttonIndex => $buttonData) {
                MenuButton::create([
                    'user_id' => $userId,
                    'label' => $buttonData['label'],
                    'link' => $buttonData['link'] ?? null,
                    'is_external' => $buttonData['is_external'] ?? false,
                    'order' => $buttonIndex,
                ]);
            }

            MenuSetting::where('user_id', $userId)->delete();
            MenuSetting::create([
                'user_id' => $userId,
                'logo_position' => $validated['logo_position'],
                'logo_size' => $validated['logo_size'],
            ]);
        });

        return redirect()->route('admin.menu')->with('success', 'Menu saved successfully!');
    }
}
