<?php
namespace MyTasks;

class Slurp extends \Rocketeer\Abstracts\AbstractTask
{
  /**
   * Description of the Task
   *
   * @var string
   */
  protected $description = 'Slurps down a copy of the current release on the server';

  // protected $local = true; // run tasks on the local environment
  
  /**
   * Executes the Task
   *
   * @return void
   */
  public function execute()
  {
    $this->explainer->line('Connecting to server');
	$connection = $this->getConnection();
	$server = $connection->connections->getServer();
	$credentials = $connection->connections->getServerCredentials($connection->connections->getConnection(), $server);

	$host = $credentials['host'];
	$hostAndPort = explode(":", $host);
	$host = $hostAndPort[0];
	if(isset($hostAndPort[1])) {
		$port = $hostAndPort[1];
	} else {
		$port = "22";
	}
	$username = $credentials['username'];
	$password = $credentials['password'];
	$key = $credentials['key'];
	$keyphrase = $credentials['keyphrase'];
    $local_path = __DIR__ . '/../slurp/live/';
	$remote_path = $this->releasesManager->getCurrentReleasePath();	
	$output = "Slurping from $host:$remote_path to $local_path";
	$this->command->info($output);
	$this->command->info("If prompted for a password, enter $password");
    @mkdir($local_path, 0700, true);
	$command = "rsync -rlpzhv --delete  --progress -e 'ssh -p $port' --exclude includes --exclude .git --exclude media --exclude var $username@$host:$remote_path $local_path";
	echo $command . "\n";
	passthru($command);
	$this->command->info("Slurped live site into $local_path");
	
	
	    return true;
  }
}
?>
