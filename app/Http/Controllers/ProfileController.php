<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        return view('admin.profile', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fname'             => 'required|string|max:255',
            'lname'             => 'required|string|max:255',
            'organisation_name' => 'required|string|max:255',
            'website_name'      => 'required|string|max:255',
            'domain'            => 'required|string|max:255',
            'website_type'      => 'required|string|max:255',
            'facebook'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'twitter'           => 'nullable|string|max:255',
            'linkedin'          => 'nullable|string|max:255',
        ]);

        Auth::user()->update($validated);
        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password'          => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (! Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.password.edit')->with('success', 'Password updated successfully.');
    }

    public function accountSettings()
    {
        $users = Auth::user();
        return view('admin.account-settings', compact('users'));
    }
}
