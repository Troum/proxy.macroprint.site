<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

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
        Http::macro('strapi', function () {
            return Http::withHeaders([
                'Authorization' => 'Bearer '. config('services.strapi.token'), #Token generated in the admin
            ])->baseUrl(config('services.strapi.url')); # Base url of your strapi app
        });
    }
}
