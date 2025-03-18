<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_data',
        'first_name',
        'last_name',
        'phone',
        'address',
        'barangay',
        'zip_code',
        'payment_option',
        'proof_of_payment',
    ];
}
