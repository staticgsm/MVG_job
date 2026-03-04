<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserSubscriptionController extends Controller
{
    public function store(Request $request, User $candidate)
    {
        // Double check super_admin role for safety, though route will be protected
        if (!auth()->user()->hasRole('super_admin')) {
            abort(403);
        }

        $request->validate([
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
        ]);

        $plan = SubscriptionPlan::findOrFail($request->subscription_plan_id);

        // 1. Create Offline Payment Record
        $txnid = 'offline_' . Str::random(10) . '_' . time();
        $payment = Payment::create([
            'user_id' => $candidate->id,
            'subscription_plan_id' => $plan->id,
            'txnid' => $txnid,
            'amount' => $plan->price,
            'currency' => 'INR',
            'status' => 'success',
            'gateway' => 'offline',
            'bank_ref_num' => 'N/A (Admin Activated)',
        ]);

        // 2. Create User Subscription
        $userSubscription = UserSubscription::create([
            'user_id' => $candidate->id,
            'subscription_plan_id' => $plan->id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays($plan->duration_days),
            'status' => 'active',
        ]);

        // 3. Update Candidate Profile flag
        $candidate->candidateProfile()->updateOrCreate(
            ['user_id' => $candidate->id],
            ['has_active_subscription' => true]
        );

        // 4. Notify User
        try {
            $candidate->notify(new \App\Notifications\SubscriptionActivated($userSubscription));
        } catch (\Exception $e) {
            // Log if notification fails but don't break the flow
            \Log::error('Offline Activation Notification Failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Subscription activated successfully (Offline).');
    }
}
