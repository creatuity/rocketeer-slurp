<?php

namespace Rocketeer\Plugins\RocketeerSlurp;

use Illuminate\Config\Repository as Config;
use AFM\Rsync\Rsync;

class SlurpSite extends \Rocketeer\Traits\Task {

    protected $name = 'slurpsite';

    protected $description = 'Downloads a copy of the live site.';

    public function execute() {
        $this->command->info("Connecting to server");

        $connection = $this->rocketeer->getConnection();

        // Load configuration for the environment (based on the Rocketeer connection) without creating a new app instance
        $config = new Config(
            $this->app->getConfigLoader(), $connection
        );

        $this->command->info("Environment detected: ".$config->getEnvironment());

        $host = $config->get('host');
        $username = $config->get('username');
        $password = $config->get('password');
        $key = $config->get('key');
        $keyphrase = $config->get('keyphrase');

        $remote_path = $this->releasesManager->getCurrentReleasePath();
        $local_path = __DIR__ '../slurp/live/';
        rmdir($local_path);
        mkdir($local_path, 0700, true);

        $ssh_config = array (
            'host' => $host,
            'public_key' => $key,
            'username' => $username,
            'password' => $password
        );

        $config = array(
            'delete_from_target' => true,
            'ssh' => $ssh_config
        );
        $rsync = new Rsync($config);
        $rsync->sync($remote_path, $local_path);

        $this->command->info("Slurped live site into $local_path");
    }
}