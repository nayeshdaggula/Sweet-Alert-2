<?php

namespace ND\SweetAlert2;

use Illuminate\Support\ServiceProvider;

class SweetAlertServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'sweet');

        $this->publishes([
            __DIR__.'/../config/sweet-alert.php' => config_path('sweet-alert.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/sweet'),
        ], 'views');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'ND\SweetAlert2\SessionStore',
            'ND\SweetAlert2\LaravelSessionStore'
        );

        $this->app->bind('nayeshdaggula.sweetalert2', function () {
            return $this->app->make('ND\SweetAlert2\SweetAlertNotifier');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'ND\SweetAlert2\SessionStore',
            'nayeshdaggula.sweetalert2',
        ];
    }
}
