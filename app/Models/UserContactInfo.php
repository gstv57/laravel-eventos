<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'address',
        'address_number',
        'neighborhood',
        'state',
        'zip',
    ];


}
