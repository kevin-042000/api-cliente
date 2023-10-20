<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surnames',
        'phone_number',
        'email',
        'birthdate',
        'address',
        'country',
        'province',
        'city',
        'postal_code',
    ];
}
