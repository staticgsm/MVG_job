<?php

namespace App\Services;

class PayUService
{
    protected $merchantKey;

    protected $merchantSalt;

    protected $baseUrl;

    public function __construct()
    {
        $this->merchantKey = config('services.payu.key');
        $this->merchantSalt = config('services.payu.salt');
        $this->baseUrl = config('services.payu.base_url', 'https://test.payu.in/_payment');
    }

    public function generateHash($params)
    {
        // Hash Sequence: key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt
        $hashSequence = 'key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt';

        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';

        foreach ($hashVarsSeq as $hash_var) {
            $hash_string .= isset($params[$hash_var]) ? $params[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $this->merchantSalt;

        return strtolower(hash('sha512', $hash_string));
    }

    public function verifyHash($params, $reversedHash)
    {
        // Response Hash Sequence: salt|status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key

        $key = $params['key'];
        $txnid = $params['txnid'];
        $amount = $params['amount'];
        $productinfo = $params['productinfo'];
        $firstname = $params['firstname'];
        $email = $params['email'];
        $status = $params['status'];
        $udf1 = $params['udf1'] ?? '';
        $udf2 = $params['udf2'] ?? '';
        $udf3 = $params['udf3'] ?? '';
        $udf4 = $params['udf4'] ?? '';
        $udf5 = $params['udf5'] ?? '';

        $retHashSeq = $this->merchantSalt.'|'.$status.'||||||'.$udf5.'|'.$udf4.'|'.$udf3.'|'.$udf2.'|'.$udf1.'|'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;

        $calculatedHash = strtolower(hash('sha512', $retHashSeq));

        return $calculatedHash === $reversedHash;
    }

    public function getPaymentUrl()
    {
        return $this->baseUrl;
    }

    public function getMerchantKey()
    {
        return $this->merchantKey;
    }
}
