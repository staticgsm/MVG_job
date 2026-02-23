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
            $profile = $user->candidateProfile;
            $completion = $profile->profile_completion_percentage ?? 0;

            // 1. Profile Completion Check - Only for Dashboard/Applications
            // We now allow Dashboard access to show the "Missing Items" checklist
            // Completion is strictly enforced at the Subscription/Apply stage

            // 2. Subscription Check - We now allow Dashboard access without a subscription.
            // Subscription is strictly enforced at the Job Application (apply) stage.
            return $next($request);
        }

        return $next($request);
    }
}
