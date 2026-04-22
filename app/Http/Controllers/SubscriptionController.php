<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\Payment;
use App\Services\PayUService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    protected $payuService;

    public function __construct(PayUService $payuService)
    {
        $this->payuService = $payuService;
    }

    public function index()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();
        $user = Auth::user();
        $currentSubscription = $user->subscription;

        return view('subscriptions.index', compact('plans', 'currentSubscription'));
    }

    public function initiate(SubscriptionPlan $plan)
    {
        $user = Auth::user();

        // Generate Transaction ID
        $txnid = 'txn_' . Str::random(10) . '_' . time();

        // Create Pending Payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'txnid' => $txnid,
            'amount' => $plan->price,
            'currency' => 'INR',
            'status' => 'pending',
            'gateway' => 'manual', // Updated to manual
        ]);

        // Handle Free Plan (Amount 0.00)
        if ($plan->price <= 0) {
            $payment->update(['status' => 'success']);

            $userSubscription = \App\Models\UserSubscription::create([
                'user_id' => $user->id,
                'subscription_plan_id' => $plan->id,
                'start_date' => \Carbon\Carbon::now(),
                'end_date' => \Carbon\Carbon::now()->addDays($plan->duration_days),
                'status' => 'active',
            ]);

            // Notify User
            try {
                $user->notify(new \App\Notifications\SubscriptionActivated($userSubscription));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Notification failed: ' . $e->getMessage());
            }

            // Update User Profile flag
            $user->candidateProfile()->updateOrCreate(
                ['user_id' => $user->id],
                ['has_active_subscription' => true]
            );

            return redirect()->route('candidate.profile.index')->with('success', 'Plan Activated Successfully! Please complete your profile to start applying for jobs.');
        }

        /* 
        // ══════════════════════════════════════════════════════════════════════
        // PREVIOUS PAYU AUTOMATED FLOW (COMMENTED OUT)
        // ══════════════════════════════════════════════════════════════════════
        
        // Prepare PayU parameters
        $params = [
            'key' => $this->payuService->getMerchantKey(),
            'txnid' => $txnid,
            'amount' => number_format($plan->price, 2, '.', ''),
            'productinfo' => $plan->name,
            'firstname' => $user->name,
            'email' => $user->email,
            'phone' => $user->mobile ?? '9999999999', // Fallback if mobile not set
            'surl' => route('payment.response'),
            'furl' => route('payment.response'),
            'udf1' => $user->id,
            'udf2' => $plan->id,
            'udf3' => '',
            'udf4' => '',
            'udf5' => '',
        ];

        // Generate Hash
        $params['hash'] = $this->payuService->generateHash($params);
        $params['action'] = $this->payuService->getPaymentUrl();

        return view('subscriptions.checkout', compact('params'));
        // ══════════════════════════════════════════════════════════════════════
        */

        // NEW MANUAL FLOW: Redirect to upload screenshot page
        return redirect()->route('candidate.subscriptions.manual', ['payment' => $payment->id]);
    }

    public function manualPayment(Payment $payment)
    {
        // Security check
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        return view('subscriptions.manual_payment', compact('payment'));
    }

    public function submitScreenshot(Request $request, Payment $payment)
    {
        // Security check
        if ($payment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'screenshot' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('payment_screenshots', 'public');
            
            $payment->update([
                'screenshot_path' => $path,
                'status' => 'pending' // Still pending until admin approval
            ]);

            return redirect()->route('candidate.dashboard')->with('success', 'Payment screenshot uploaded successfully. Admin will verify and activate your subscription shortly.');
        }

        return back()->with('error', 'Please select a valid image file.');
    }
}
