<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class organizer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'password', 'prev_images'];
    protected $casts = [
        'prev_images' => 'array',
        'email_verified_at' => 'datetime',
    ];
}
