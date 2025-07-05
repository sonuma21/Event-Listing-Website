<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Organizer extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'phone', 'password', 'prev_images'];
    protected $casts = [
        'prev_images' => 'array',
        'email_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }
    public function checkouts(): HasMany
    {
        return $this->hasMany(Checkout::class);
    }
}
