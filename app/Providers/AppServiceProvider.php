<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View; // 1. Import View Facade
use Illuminate\Support\Facades\Schema; // 2. Import Schema Facade
use App\Models\Pengaturan; // 3. Import Model Pengaturan

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
        Paginator::useBootstrapFive();

        // 4. Tambahkan blok kode ini
        // Ini akan membagikan data pengaturan ke semua view yang dirender
        if (Schema::hasTable('pengaturan')) {
            $pengaturan = Pengaturan::all()->keyBy('key');
            View::share('pengaturan', $pengaturan);
        }
    }
}
