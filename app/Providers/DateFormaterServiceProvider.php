<?php

namespace App\Providers;

use App\Services\DateFormater;
use Illuminate\Support\ServiceProvider;

class DateFormaterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('dateformater', DateFormater::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
