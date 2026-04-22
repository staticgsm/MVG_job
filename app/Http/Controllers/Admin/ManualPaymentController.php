<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManualPaymentController extends Controller
{
    public function index()
    {
        // Only show manual payments that are pending but have a screenshot uploaded
        $payments = Payment::with(['user', 'subscriptionPlan'])
            ->where('gateway', 'manual')
            ->whereNotNull('screenshot_path')
            ->latest()
            ->paginate(15);

        return view('admin.payments.index', compact('payments'));
    }

    public function approve(Payment $payment)
    {
        // 1. Mark Payment as Success
        $payment->update([
            'status' => 'success',
            'bank_ref_num' => 'Manual Approval - ' . auth()->user()->name
        ]);

        // 2. Create/Update User Subscription
        $plan = $payment->subscriptionPlan;
        $user = $payment->user;

        $userSubscription = UserSubscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays($plan->duration_days),
            'status' => 'active',
        ]);

        // 3. Update Candidate Profile flag
        $user->candidateProfile()->updateOrCreate(
            ['user_id' => $user->id],
            ['has_active_subscription' => true]
        );

        // 4. Notify User
        try {
            $user->notify(new \App\Notifications\SubscriptionActivated($userSubscription));
        } catch (\Exception $e) {
            \Log::error('Manual Verification Notification Failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Payment verified and subscription activated for ' . $user->name);
    }

    public function reject(Request $request, Payment $payment)
    {
        $request->validate([
            'notes' => 'nullable|string|max:500'
        ]);

        $payment->update([
            'status' => 'failed',
            'admin_notes' => $request->notes
        ]);

        return back()->with('error', 'Payment rejected.');
    }
}
