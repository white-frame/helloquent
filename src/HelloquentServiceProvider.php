<?php namespace WhiteFrame\Helloquent;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use WhiteFrame\Support\Application;

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
        $this->app->singleton('white-frame.helloquent.builder.manager', function ($app) {
            return new \WhiteFrame\Helloquent\Builder\Manager();
        });

        Application::alias('WhiteFrame\Helloquent', 'WhiteFrame\Helloquent\Builder\Facades\ManagerFacade');
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'helloquent');
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