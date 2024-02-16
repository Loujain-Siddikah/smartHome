<?php

namespace App\Providers;

use App\Contracts\PinRepositoryInterface;
use App\Repositories\PinRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(PinRepositoryInterface::class, PinRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
