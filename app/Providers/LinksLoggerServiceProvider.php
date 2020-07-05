<?php

namespace App\Providers;

use App\Contracts\LinksLoggerInterface;
use App\Services\LinksLogger\LinksLogger;
use Illuminate\Support\ServiceProvider;

class LinksLoggerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LinksLoggerInterface::class, LinksLogger::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
