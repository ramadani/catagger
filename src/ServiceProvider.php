<?php

namespace Redustudio\Catagger;

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
        //
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
