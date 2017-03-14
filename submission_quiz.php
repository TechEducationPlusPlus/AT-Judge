<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$sql = "SELECT * FROM `QuizResults`";
	$result = $conn->query($sql);
	$ID = $result->num_rows;
	$CONTEST = $_REQUEST["contest"];
	$USER = $_REQUEST["email"];
	if ($conn->query ("SELECT * FROM `Users` WHERE `Email`='{$USER}'")->num_rows == 0)
	{
		echo '<script>alert("Don\'t cheat! Haven\'t got any user with that email!"); window.history.back ();</script>';
	}
	else
	{
		$Result = 0;
		$contest = $conn->query("SELECT * FROM `Quizes` WHERE `ID`=\"{$CONTEST}\";")->fetch_assoc ();
		$json = explode(",", $contest["Tasks"]);
		foreach ($json as $key)
		{
			//echo $key;
			//echo "<br>";
			//echo $_REQUEST[$key];
			//echo "<br>";
			//echo $conn->query("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$key}\";")->fetch_assoc()["Answer"];
			if ($_REQUEST[$key] == $conn->query("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$key}\";")->fetch_assoc()["Answer"])
				$Result = $Result + $conn->query("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$key}\";")->fetch_assoc()["Points"];
		}
		$result = $conn->query("INSERT INTO `QuizResults` (`UserID`,`QuizID`,`Result`) VALUES (\"{$USER}\",\"{$CONTEST}\",\"{$Result}\");");
		echo '
<html lang="en">
<head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><meta name="description" content="Open Source Free Judge System"><meta name="author" content="Alex Tsvetanov"><meta name="keywords" content="Judge, Online, System, Programming, Languages, Algorithms"><meta name="distribution" content="web"><meta name="robots" content="index, follow"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><link rel="icon" href="/favicon.png"><title>Judge :: TechEdu ++</title><link href="/css/jumbotron.css" rel="stylesheet"><link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,400,500,700"><link rel="stylesheet" href="//fonts.googleapis.com/icon?family=Material+Icons"><link rel="stylesheet" href="/css/bootstrap.min.css"><link rel="stylesheet" href="/css/bootstrap-material-design.min.css"><link rel="stylesheet" href="/css/ripples.min.css"><link rel="stylesheet" href="/css/snackbar.min.css"><link rel="stylesheet" href="/css/extension.css">
		<style> 
		.progress {
			position: relative;
		}

		.progress span {
			position: absolute;
			display: block;
			width: 100%;
		}
		</style>
	</head>

	<body>
		<nav class="navbar navbar-static-top navbar-default"><a href="#" class="navbar-brand">TechEdu ++</a><div class="navbar-collapse collapse navbar-responsive-collapse"><ul class="nav navbar-nav"><li class="nav-item active"><a href="#" class="nav-link">Home</a></li><li class="nav-item"><a href="/contactus.php" class="nav-link">Contact</a></li><li class="nav-item"><a href="/aboutus.php" class="nav-link">About</a></li></ul><form role="search" action="/search.php" class="navbar-form navbar-left"><div class="form-group is-empty"><input placeholder="Search" name="pattern" class="form-control col-md-8" type="text"></div></form><ul class="nav navbar-nav navbar-right"><li id="login" class="nav-item"><a class="nav-link" href="/logout.php">Logout</a></li><li class="nav-item"><a href="/register.php" class="nav-link">Register</a></li><li style="border-right: rgba(0,0,0,0) solid 20px;" class="nav-item active"><a href="/user.php" class="nav-link">Hi, ' . $_COOKIE["name"] . '</a></li></ul></div></nav>

		<div class="container">
			<h2>Your score is:</h2>
			<div class="progress" style="min-height: 40px;">
			  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="' . $Result . '" aria-valuemin="0" aria-valuemax="' . count($json) . '" style="width:' . (100 * $Result / count($json)) . '%">
			  <span><h4>' . $Result . ' / ' . count($json) . '</h4></span>
			  </div>
			</div>
			<a class="btn btn-info btn-raised" href="' . $contest["Link"] . '">Back to test</a>
			<a class="btn btn-success btn-raised" href="' . $contest["Link"] . '/results">Go to results</a>
		</div>
	</body>
</html>
';
	}
////include ($_SERVER["DOCUMENT_ROOT"] . "/lib/queue.php");
////print_queue ();
?>
