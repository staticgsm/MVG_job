<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobNotification extends Model
{
    protected $guarded = [];

    public function jobPost()
    {
        return $this->belongsTo(JobPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
