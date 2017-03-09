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
			echo $key;
			echo "<br>";
			echo $_REQUEST[$key];
			echo "<br>";
			echo $conn->query("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$key}\";")->fetch_assoc()["Answer"];
			if ($_REQUEST[$key] == $conn->query("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$key}\";")->fetch_assoc()["Answer"])
				$Result = $Result + $conn->query("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$key}\";")->fetch_assoc()["Points"];
		}
		$result = $conn->query("INSERT INTO `QuizResults` (`UserID`,`QuizID`,`Result`) VALUES (\"{$USER}\",\"{$CONTEST}\",\"{$Result}\");");
		echo '<script>window.history.back ();</script>';
	}
////include ($_SERVER["DOCUMENT_ROOT"] . "/lib/queue.php");
////print_queue ();
?>
