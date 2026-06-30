<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user();
        // dd($user->logo); 
        return view('admin.dashboard');
    }
}
