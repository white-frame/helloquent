<?php namespace WhiteFrame\Helloquent;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use WhiteFrame\Support\Application;
use WhiteFrame\Support\Framework;

/**
 * Class HelloquentServiceProvider
 * @package WhiteFrame\Helloquent
 */
class HelloquentServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     */
    public function register()
    {
        Framework::registerPackage('helloquent');
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}