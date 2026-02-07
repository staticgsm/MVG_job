<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'location',
        'eligibility',
        'experience',
        'salary_range',
        'job_type',
        'description',
        'status',
    ];

    public function scopeOpen($query)
    {
        return $query->where('status', 'Open');
    }
}
