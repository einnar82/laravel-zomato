<?php

namespace RannieOllit\Zomato;

use Illuminate\Support\ServiceProvider;
use RannieOllit\Zomato\Zomato;

class ZomatoServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/zomato.php', 'zomato');

        // Register the service the package provides.
        $this->app->singleton('zomato', function($app) {
            $config = isset($app['config']['services']['zomato']) ? $app['config']['services']['zomato'] : null;

            if (is_null($config)) {
                $config = $app['config']['zomato'];
            }

            $client = new Zomato($config['api_key']);

            return $client;
           });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['zomato'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/zomato.php' => config_path('zomato.php'),
        ], 'zomato.config');
    }
}
