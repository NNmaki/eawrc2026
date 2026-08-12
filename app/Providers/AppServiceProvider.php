<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\StageTime;
use App\Observers\RecordObserver;

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
        StageTime::observe(RecordObserver::class);
    }
}
