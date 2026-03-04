<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CandidateOnboarding
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
            // 1. Subscription Check - FIRST PRIORITY
            $hasActiveSubscription = $user->subscription()->exists() &&
                                     $user->subscription->end_date->isFuture();

            // Exclude subscription routes from redirection to avoid infinite loop
            if (!$hasActiveSubscription && !$request->routeIs('candidate.subscriptions.*')) {
                return redirect()->route('candidate.subscriptions.index')->with('info', 'Please subscribe to a plan to unlock all features.');
            }

            // 2. Profile Completion Check - Only for Dashboard/Applications
            // We now allow Dashboard access to show the "Missing Items" checklist
            // Completion is strictly enforced at the Subscription/Apply stage
            return $next($request);
        }

        return $next($request);
    }
}
