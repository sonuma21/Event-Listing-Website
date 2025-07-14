<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class event extends Model
{
    protected $casts = [
        'images' => 'array',
    ];

    public function organizer(): BelongsTo
    {
        return $this->belongsTo(Organizer::class);
    }
     public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }
    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class);
    }
}
