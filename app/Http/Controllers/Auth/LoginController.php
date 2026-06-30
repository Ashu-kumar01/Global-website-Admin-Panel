<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showForm()
    {
        $user = Auth::user();
        // dd($user->name);
        $this->generateCaptcha();
        return view('login', compact('user'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_id'  => ['required', 'string'],
            'password' => ['required', 'string'],
            'captcha'  => ['required', 'string'],
        ]);

        if ((int) $request->captcha !== (int) session('captcha_answer')) {
            $this->generateCaptcha();
            return back()
                ->withErrors(['captcha' => 'Incorrect answer. Please try again.'])
                ->withInput($request->except('password', 'captcha'));
        }

        $field = filter_var($request->user_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        if (Auth::attempt([$field => $request->user_id, 'password' => $request->password], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        $this->generateCaptcha();
        return back()
            ->withErrors(['user_id' => 'These credentials do not match our records.'])
            ->withInput($request->except('password', 'captcha'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    private function generateCaptcha(): void
    {
        $a = rand(2, 9);
        $b = rand(1, 9);
        $ops = ['+', '-'];
        $op  = $ops[array_rand($ops)];

        $answer = match ($op) {
            '+'  => $a + $b,
            '-'  => $a - $b,
            // '×'  => $a * $b,
        };

        session([
            'captcha_question' => "{$a} {$op} {$b}",
            'captcha_answer'   => $answer,
        ]);
    }
}
