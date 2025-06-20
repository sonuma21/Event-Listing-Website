<?php

namespace App\Providers;

use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Event::observe(EventObserver::class);
    }
}
