<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // Ensure correct table name

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'category',
        'image_path',
        'shipping_rules', // Added shipping_rules field
        'weight', // Added weight field
    ];

    protected $casts = [
        'shipping_rules' => 'array', // Cast shipping_rules as an array
    ];

    public $timestamps = false; // Prevent Laravel from using updated_at and created_at

    // Set default value for weight
    protected $attributes = [
        'weight' => 500, // Default weight
    ];
}
