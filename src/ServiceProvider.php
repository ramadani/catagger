<?php

namespace Redustudio\Catagger;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Class PackageServiceProvider
 *
 * @package Redustudio\Catagger
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CataggerContract::class, Catagger::class);
    }

    /**
     * Application is booting
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
        $this->registerConfigurations();
        $this->registerEvents();
    }

    /**
     * Register the package migrations
     *
     * @return void
     */
    protected function registerMigrations()
    {
        $this->loadMigrationsFrom($this->packagePath('database/migrations'));

        $this->publishes([
            $this->packagePath('database/migrations') => database_path('/migrations')
        ], 'migrations');
    }

    /**
     * Register the package configurations
     *
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/config.php'),
            'redustudio.catagger'
        );

        $this->publishes([
            $this->packagePath('config/config.php') => config_path('redustudio/catagger.php'),
        ], 'config');
    }

    /**
     * Register events
     *
     * @return void
     */
    protected function registerEvents()
    {
        $this->app->make(Dispatcher::class)->listen('cataggable.sync', function ($type) {

            // It's a bad design?
            $this->app->singleton('cataggable.catagger_type', function () use ($type) {
                return $type;
            });
        });
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__, $path);
    }
}
