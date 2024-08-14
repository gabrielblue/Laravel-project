<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'image', 'username', 'email', 'phone_number', 'location',
        'education', 'workspace', 'instagram_link', 'skills', 'current_occupation',
        'linkedin_profile', 'gender', 'age',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
