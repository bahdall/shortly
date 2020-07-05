<?php

namespace App\Providers;

use App\Contracts\HashLinkInterface;
use App\Services\LinkShorter\HashLink;
use Illuminate\Support\ServiceProvider;

class HashLinkServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HashLinkInterface::class, HashLink::class);
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
