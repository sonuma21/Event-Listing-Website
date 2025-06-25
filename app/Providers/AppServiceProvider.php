<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\event;
use Illuminate\Support\Facades\View;
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
        // View::share('categories', Category::all());
        // View::share('latest_events', event::all());

    }
}
