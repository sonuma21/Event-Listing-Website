<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class organizer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'password', 'prev_images'];
    protected $casts = [
        'prev_images' => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get all of the events for the organizer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
