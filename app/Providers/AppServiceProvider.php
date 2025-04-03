<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use App\Models\Role;
use App\Models\User;

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
        //
    }
}
