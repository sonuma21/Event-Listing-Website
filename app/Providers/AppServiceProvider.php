<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\EventObserver;
use Illuminate\Database\Eloquent\Model;
use App\Models\event;
use App\Models\PaymentRequest;
use App\Observers\PaymentObserver;
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
        PaymentRequest::observe(PaymentObserver::class);


    }
}
