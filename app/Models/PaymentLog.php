<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class PaymentLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'raw_response' => 'array',
    ];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
