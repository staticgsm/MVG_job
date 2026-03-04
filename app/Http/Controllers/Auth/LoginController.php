<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(\Illuminate\Http\Request $request, $user)
    {
        if ($user->hasRole('candidate')) {
            $hasActiveSubscription = $user->subscription()->exists() &&
                                     $user->subscription->end_date->isFuture();

            if (!$hasActiveSubscription) {
                return redirect()->route('candidate.subscriptions.index')->with('info', 'Please subscribe to a plan to unlock all features.');
            }

            return redirect()->route('candidate.dashboard');
        }

        if ($user->hasRole('super_admin')) {
            return redirect()->route('super_admin.dashboard');
        }

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('hr')) {
            return redirect()->route('hr.dashboard');
        }

        if ($user->hasRole('accountant')) {
            return redirect()->route('accountant.dashboard');
        }

        return redirect($this->redirectTo);
    }
}
