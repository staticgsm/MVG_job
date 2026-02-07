<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentLog;
use App\Models\UserSubscription;
use App\Services\PayUService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    protected $payuService;

    public function __construct(PayUService $payuService)
    {
        $this->payuService = $payuService;
    }

    public function response(Request $request)
    {
        $data = $request->all();

        // 1. Log Raw Response
        $txnid = $data['txnid'] ?? null;
        $status = $data['status'] ?? 'unknown';

        // Map PayU 'failure' to 'failed' for DB consistency
        $dbStatus = $status;
        if ($status === 'failure') {
            $dbStatus = 'failed';
        }

        $payment = Payment::where('txnid', $txnid)->first();

        try {
            PaymentLog::create([
                'payment_id' => $payment ? $payment->id : null,
                'txnid' => $txnid,
                'mihpayid' => $data['mihpayid'] ?? null,
                'status' => $status, // Log original status
                'error_message' => $data['error_Message'] ?? $data['error'] ?? null,
                'raw_response' => $data,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create PaymentLog: ' . $e->getMessage());
        }

        if (!$payment) {
            return redirect()->route('login')->with('error', 'Invalid Transaction ID.');
        }

        // Re-login user manually as session might be lost during callback
        if (!Auth::check() || Auth::id() != $payment->user_id) {
            Auth::login($payment->user);
        }

        // 2. Verify Hash
        $reversedHash = $data['hash'] ?? '';
        // Verify Hash Logic manually here or use service
        // Salt|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key

        $key = $data['key'] ?? '';
        $amount = $data['amount'] ?? '';
        $productinfo = $data['productinfo'] ?? '';
        $firstname = $data['firstname'] ?? '';
        $email = $data['email'] ?? '';
        $udf1 = $data['udf1'] ?? '';
        $udf2 = $data['udf2'] ?? '';
        $udf3 = $data['udf3'] ?? '';
        $udf4 = $data['udf4'] ?? '';
        $udf5 = $data['udf5'] ?? '';
        $salt = config('services.payu.salt');
        $additionalCharges = $data['additionalCharges'] ?? '';

        $retHashSeq = $salt . '|' . $status . '||||||' . $udf5 . '|' . $udf4 . '|' . $udf3 . '|' . $udf2 . '|' . $udf1 . '|' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
        
        if (!empty($additionalCharges)) {
            $retHashSeq = $additionalCharges . '|' . $retHashSeq;
        }

        $calculatedHash = strtolower(hash('sha512', $retHashSeq));

        if ($calculatedHash !== $reversedHash) {
             // Debugging Log for mismatch
             Log::warning('PayU Hash Mismatch', [
                 'calculated' => $calculatedHash,
                 'reversed' => $reversedHash,
                 'seq' => $retHashSeq
             ]);
             
             $payment->update(['status' => 'failed']);
             return redirect()->route('candidate.subscriptions.index')->with('error', 'Security Error: Hash Verification Failed.');
        }

        // 3. Update Payment Status
        $payment->update([
            'status' => $dbStatus, // Use mapped status
            'mihpayid' => $data['mihpayid'] ?? null,
            'bank_ref_num' => $data['bank_ref_num'] ?? null,
        ]);

        // 4. Activate Subscription
        if ($status === 'success') {
            
            // Check for existing active subscription and expire it if policy says so, or extend?
            // For now, assuming new subscription replaces old.
            
            $plan = $payment->subscriptionPlan;
            
            UserSubscription::create([
                'user_id' => $payment->user_id,
                'subscription_plan_id' => $plan->id,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays($plan->duration_days),
                'status' => 'active',
            ]);

            // Update User Profile flag
            $payment->user->candidateProfile()->update(['has_active_subscription' => true]);

            return redirect()->route('candidate.profile.index')->with('success', 'Payment Successful! Subscription Activated.');
        }

        return redirect()->route('candidate.subscriptions.index')->with('error', 'Payment Failed. Please try again.');
    }
}
