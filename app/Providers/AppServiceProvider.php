<?php

namespace App\Providers;

use App\Models\Critere;
use App\Models\Diligence;
use App\Models\Service;
use App\Models\Traitement;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // Define relationships
        Paginator::useBootstrapFive();
    }
}
