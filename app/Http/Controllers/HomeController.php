<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return redirect()->route('super_admin.dashboard');
        } elseif ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('hr')) {
            return redirect()->route('hr.dashboard');
        } elseif ($user->hasRole('accountant')) {
            return redirect()->route('accountant.dashboard');
        }

        return view('home');
    }
}
