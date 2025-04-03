<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'user_id',
        'page_id',
    ];

    // Define the relationship: A Client belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
