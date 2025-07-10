<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model

{
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(event::class)->where('status', 'approved');
    }
}
