<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Firebase\Auth\Token\Verifier;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dd((openssl_get_cert_locations()));
        $this->app->singleton(Verifier::class, function ($app) {
            return new Verifier(config('services.firebase.project_id'));
        });
    }
}
