<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
