<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'qualifications',
        'location',
        'image',
        'views',
    ];

    /**
     * Get the applications for the job.
     */
    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    /**
     * The skills that belong to the job.
     */
    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'job_skill');
    }
}
