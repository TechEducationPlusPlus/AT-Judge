<?php
	if ($_SERVER["REQUEST_URI"] == '/queue')
	{
		include (__DIR__ . "/lib/queue.php");
		print_queue ();
		return false;
	}
	else if (preg_match("/\/contests\/.*\/results/i", $_SERVER["REQUEST_URI"])) 
	{
		include (__DIR__ . "/lib/result.php");
		print_results ();
		return false;
	}
	else if (preg_match("/\/submit\/.*/i", $_SERVER["REQUEST_URI"])) 
	{

		$_REQUEST ["id"] = substr ($_SERVER["REQUEST_URI"], 8);
		include (__DIR__ . "/lib/get_submission.php");
		return false;
	}
	else if (substr ($_SERVER["REQUEST_URI"], 0, 10) == '/contests/')
	{
		include (__DIR__ . "/lib/contest.php");
		print_contest ($_SERVER["REQUEST_URI"]);
		//echo "Contest is not ready!";
		return false;
	}
	else
	{
		$_GET['_uri'] = $_SERVER['REQUEST_URI'] . '.php';
		return false;
	}
?>
