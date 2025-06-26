<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarouselImage extends Model
{
    protected $table = 'carousel_image';
    protected $casts = [
        'images' => 'array',
    ];
}
