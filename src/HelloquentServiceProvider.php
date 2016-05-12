<?php namespace WhiteFrame\Helloquent;

use App\User;
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

    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        //dd(User::email('admin@admin.com')->toSql());
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