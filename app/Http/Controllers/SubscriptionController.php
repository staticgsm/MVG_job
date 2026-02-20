<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\SubscriptionPlan;
use App\Services\PayUService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    protected $payuService;

    public function __construct(PayUService $payuService)
    {
        $this->payuService = $payuService;
        $this->middleware('auth');
    }

    public function index()
    {
        $plans = SubscriptionPlan::where('is_active', true)->get();
        $currentSubscription = auth()->user()->subscription; // Get active subscription

        return view('subscriptions.index', compact('plans', 'currentSubscription'));
    }

    public function initiate(Request $request, SubscriptionPlan $plan)
    {
        $user = auth()->user();
        $txnid = 'txn_'.Str::random(10).'_'.time();

        // Create Initiate Payment Record
        $payment = Payment::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'txnid' => $txnid,
            'amount' => $plan->price,
            'currency' => 'INR',
            'status' => 'initiated',
            'gateway' => 'payu',
        ]);

        $params = [
            'key' => $this->payuService->getMerchantKey(),
            'txnid' => $txnid,
            'amount' => number_format($payment->amount, 2, '.', ''), // Ensure 2 decimal places
            'productinfo' => $plan->name,
            'firstname' => $user->name,
            'email' => $user->email,
            'phone' => $user->mobile ?? '9999999999',
            'surl' => route('payment.response'),
            'furl' => route('payment.response'),
            'udf1' => '',
            'udf2' => '',
            'udf3' => '',
            'udf4' => '',
            'udf5' => '',
        ];

        // Generate Hash
        // key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt
        $hashString = $params['key'].'|'.$params['txnid'].'|'.$params['amount'].'|'.$params['productinfo'].'|'.$params['firstname'].'|'.$params['email'].'|'.$params['udf1'].'|'.$params['udf2'].'|'.$params['udf3'].'|'.$params['udf4'].'|'.$params['udf5'].'||||||'.config('services.payu.salt');

        \Illuminate\Support\Facades\Log::info('PayU Params:', $params); // Debug Log

        $hash = strtolower(hash('sha512', $hashString));
        $params['hash'] = $hash;
        $params['action'] = config('services.payu.base_url');

        return view('subscriptions.checkout', compact('params'));
    }
}
