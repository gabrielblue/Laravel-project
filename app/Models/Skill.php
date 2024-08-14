<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];

    protected $hidden = ['pivot'];

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_skill');
    }

    public function jobApplications()
    {
        return $this->belongsToMany(JobApplication::class, 'job_application_skill');
    }
}
