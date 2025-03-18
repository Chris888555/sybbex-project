<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    // Define the fillable attributes (columns that can be mass-assigned)
    protected $fillable = [
        'title', 'video_link', 'thumbnail_url', // Add 'thumbnail_url' here
    ];
}
