<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateEducation extends Model
{
    use HasFactory;

    protected $table = 'candidate_educations';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
