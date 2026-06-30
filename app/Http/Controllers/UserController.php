<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {

        // 
        $validated = $request->validate([
            // Step 1
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email_id',
            'mobile_number' => 'required|digits:10|unique:users,mobile_number',
            'password' => 'required|min:8|same:confirmed_password',
            'confirmed_password' => 'required',

            // Step 2
            'organisation_name' => 'required|string|max:255',
            'website_name' => 'required|string|max:255',
            'domain' => 'required|string|max:50',
            'website_type' => 'required|string|max:100',
            'web_descroption' => 'required|string|min:20',
            'location' => 'nullable|string|max:255',
            'target_audience' => 'nullable|string|max:255',

            // Step 3
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedIn' => 'nullable|url',
            'youtube' => 'nullable|url',
            'whatsapp' => 'nullable|digits:10',

            // Step 4
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'primary_color' => [
                'nullable',
                'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'
            ],
            'tagline' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:2000',
            'terms' => 'required|accepted',
        ], [
            'fname.required' => 'First name is required.',
            'lname.required' => 'Last name is required.',
            'email_id.required' => 'Email is required.',
            'email_id.unique' => 'Email already exists.',
            'mobile_number.required' => 'Mobile number is required.',
            'mobile_number.digits' => 'Mobile number must be 10 digits.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.same' => 'Password and confirm password do not match.',
            'organisation_name.required' => 'Organisation name is required.',
            'website_name.required' => 'Website name is required.',
            'website_type.required' => 'Please select website type.',
            'web_descroption.required' => 'Website description is required.',
            'terms.accepted' => 'Please accept Terms & Conditions.',
        ]);

        
        $validated['name'] = $validated['fname'] . ' ' . $validated['lname'];
        $validated['email'] = $validated['email_id'] = $validated['email'];
        $validated['password'] = Hash::make($validated['password']);
        $validated['terms'] = $request->boolean('terms');

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

            $validated['logo'] = 'upload/' . $filename;
        }

        $user = User::create($validated);

        return redirect()->route('login')->with('success', 'User created successfully!');
    }
}
