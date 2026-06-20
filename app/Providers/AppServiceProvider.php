<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Vite;

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
        // Jalankan config ini khusus pas aplikasi jalan di production (Vercel)
        if (config('app.env') === 'production') {
            
            // 1. Maksa Vite nyari manifest di path public yang bener saat di Vercel
            Vite::useManifestFilename('build/manifest.json');
            
            // 2. Paksa semua form action dan internal link Laravel pakai HTTPS
            URL::forceScheme('https');
        }
    }
}