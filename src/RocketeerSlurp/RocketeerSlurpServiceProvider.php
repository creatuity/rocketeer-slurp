<?php
namespace Rocketeer\Plugins\RocketeerSlurp;

use Illuminate\Support\ServiceProvider;
use Rocketeer\Facades\Rocketeer;

/**
 * Register the Slurpplugin with the Laravel framework and Rocketeer
 */
class RocketeerSlurpServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register classes
     *
     * @return void
     */
    public function register()
    {
        $this->commands("deploy.slurpsite");
        // $this->commands("deploy.dbcreate");
    }

    /**
     * Boot the plugin
     *
     * @return void
     */
    public function boot()
    {
        Rocketeer::plugin('Rocketeer\Plugins\RocketeerSlurp');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
