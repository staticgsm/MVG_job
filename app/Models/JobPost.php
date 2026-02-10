<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'project_name',
        'job_code',
        'description',
        'skills_required',
        'experience',
        'salary_range',
        'location',
        'job_type',
        'status',
        'deadline_date',
        'posted_by',
        'education_required',
        'department',
        'eligibility',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->job_code)) {
                $year = date('y'); // e.g., 26
                $prefix = 'MVG-J' . $year;

                // Find last job code with this prefix
                $lastJob = self::where('job_code', 'like', $prefix . '%')
                    ->orderBy('id', 'desc')
                    ->first();

                if ($lastJob) {
                    // Extract sequence from last job code
                    // Format: MVG-J2601. Length of prefix (MVG-J26) is 5+2=7? No.
                    // MVG-J = 5 chars. 26 = 2 chars. Total 7 chars prefix.
                    // Substring from index 7 to end.
                    $lastSequence = intval(substr($lastJob->job_code, 7));
                    $newSequence = $lastSequence + 1;
                } else {
                    $newSequence = 1;
                }

                $job->job_code = $prefix . str_pad($newSequence, 2, '0', STR_PAD_LEFT);
            }
        });
    }

    protected $casts = [
        'skills_required' => 'array',
        'education_required' => 'array',
        'deadline_date' => 'date',
    ];

    public function scopeOpen($query)
    {
        return $query->where('status', 'Open');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }
}
