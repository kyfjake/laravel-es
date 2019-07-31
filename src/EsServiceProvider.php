<?php

namespace LaravelEs;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;
use LaravelEs\Commands\LaravelEsCommand;

class EsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/laravel-es.php', 'laravel-es'
        );
        $this->commands([
            LaravelEsCommand::class,
        ]);

        $this->app->singleton('es', function () {
            $config = config('laravel-es');
            $config['logger'] = $this->app['log'];
            return ClientBuilder::fromConfig($config, true);
        });
    }

    public function provides()
    {
        return [
            'es'
        ];
    }
}