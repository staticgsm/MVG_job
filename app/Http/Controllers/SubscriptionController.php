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
        $txnid = 'MVG_' . Str::random(10) . '_' . time();

        // Create Pending Payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'txnid' => $txnid,
            'amount' => $plan->price,
            'currency' => 'INR',
            'status' => 'pending',
            'gateway' => 'payu',
        ]);

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
    }
}
