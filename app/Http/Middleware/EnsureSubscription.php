<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->hasRole('candidate')) {
            // Check if user has an active subscription
            if (!$user->candidateProfile || !$user->candidateProfile->has_active_subscription) {
                return redirect()->route('candidate.subscriptions.index')->with('error', 'Please subscribe to a plan to access your profile and apply for jobs.');
            }
        }

        return $next($request);
    }
}
