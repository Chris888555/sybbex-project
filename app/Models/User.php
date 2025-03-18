<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'password_reset_token',
        'password_reset_expires', 'is_admin', 'approved',
        'profile_picture', 'default_profile', 'is_online', 'subdomain',
        'referral_code', 'referred_by', // Ensure these fields are fillable
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'password_reset_expires' => 'datetime',
        'is_admin' => 'boolean',
        'approved' => 'boolean',
        'is_online' => 'boolean',
    ];

    // Define the relationship between users and referrers
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referred_by'); // One user can refer many users
    }

    // Define the relationship between a user and the users they referred
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referred_by'); // A user can refer multiple users
    }
}
