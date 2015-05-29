<?php
namespace Rocketeer\Plugins\RocketeerSlurp;

use Illuminate\Container\Container;
use Rocketeer\Services\Tasks\TasksQueue;
use Rocketeer\Abstracts\AbstractPlugin;

class RocketeerSlurp extends AbstractPlugin
{
	/**
	 * Setup the plugin
	 *
	 */
	public function __construct()
	{
	}

    /**
     * Bind additional classes to the Container
     *
     * @param Container $app
     *
     * @return void
     */
    public function register(Container $app)
    {
        $app->bind('slurp', function ($app) {
            return new RocketeerSlurp();
        });

        return $app;
    }

    /**
     * Register Tasks with Rocketeer
     *
     * @param TasksQueue $queue
     *
     * @return void
     */
    public function onQueue(TasksQueue $queue)
    {
    }

}
