<?php
	require_once __DIR__.'/vendor/autoload.php';
	use Symfony\Component\Process\Process;
	use Symfony\Component\Process\Exception\ProcessFailedException;

	class BoxThread// extends Thread 
	{
		private $cmd;
		public $output;
		public function __construct ($cmd)
		{
			$this->cmd = $cmd;
			$process = new Process($cmd);
			$process->run ();
			if (!$process->isSuccessful()) {
				throw new ProcessFailedException($process);
			}
			$this->output = $process->getOutput ();
			unset ($process);
		}
		public function getOutput ()
		{
			return $this->output;
		}
		public function destroyOuput ()
		{
			unset ($this->output);
		}
	}

	class Box
	{
		private $id;
		function __construct ($id)
		{
			$this->id = $id;
			$process = new Process('isolate --box-id=' . $id . ' --init');
			$process->run();
			if (!$process->isSuccessful()) 
			{
				throw new ProcessFailedException($process);
			}
			unset ($process);
		}
		function __destruct ()
		{
			$process = new Process('isolate --box-id=' . $this->id . ' --cleanup');
			$process->run();
			if (!$process->isSuccessful()) 
			{
				throw new ProcessFailedException($process);
			}
			unset ($process);
		}
		function doCommand ($cmd)
		{
			$boxThread = new BoxThread ($cmd);
			$output = $boxThread->getOutput ();
			$boxThread -> destroyOuput ();
			return $output;
		}
		function doIsolatedCommand ($cmd)
		{
			$boxThread = new BoxThread ('isolate --box-id=' . $this->id . ' --run ' . $cmd);
			$output = $boxThread -> getOutput ();
			$boxThread -> destroyOuput ();
			return $output;
		}
		function getPath ()
		{
			return '/tmp/box/' . $this->id . '/box/';
		}
	}

	$box1 = new Box (1);
	echo $box1->doCommand ('/usr/bin/ls');
	echo "<br><hr>";
	echo $box1->doCommand ('/usr/bin/cp /home/alex/a.cpp ' . $box1->getPath ());
	echo $box1->doCommand ('/usr/bin/g++ ' . $box1->getPath () . 'a.cpp -o ' . $box1->getPath () . 'a.exe');
	echo $box1->doIsolatedCommand ('/usr/bin/ls');
	echo "<br><hr>";
	echo $box1->doIsolatedCommand ('./a.exe');
	echo "<br><hr>";
	echo $box1->doIsolatedCommand ('while true; do /usr/bin/echo "a"; done');
	echo $box1->doIsolatedCommand ('while true; do /usr/bin/echo "b"; done');
?>
