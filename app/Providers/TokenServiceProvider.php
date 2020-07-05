<?php

namespace App\Providers;

use App\Contracts\TokenGeneratorInterface;
use App\Services\TokenGenerator\TokenGenerator;
use Illuminate\Support\ServiceProvider;

class TokenServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TokenGeneratorInterface::class, TokenGenerator::class);
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
