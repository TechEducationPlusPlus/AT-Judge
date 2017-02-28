<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$sql = "SELECT * FROM `Submissions`";
	$result = $conn->query($sql);
	$ID = $result->num_rows;
	//echo $ID;
	//echo "<br><hr><br>";
	$CONTEST = $_REQUEST["contest"];
	$USER = $_REQUEST["email"];
	if ($conn->query ("SELECT * FROM `Users` WHERE {$USER}")->num_rows != 1)
	{
		echo '<script>alert("Don\'t cheat! Haven\'t got any user with that email!"); window.location = "/queue";</script>';
	}
	else
	{
		$CODE = "";
		if ($_REQUEST["sourcecode"] == "")
		{
	////	echo "no code";
	////	var_export ($_FILES);
	////	var_dump ($_FILES);
	////	echo $_FILES['uploadedfile']['tmp_name'];
			$CODE = urlencode (file_get_contents ($_FILES['uploadedfile']['tmp_name']));
		}
		else
		{
	////	echo "some code lines";
			$CODE = urlencode ($_REQUEST["sourcecode"]);
		}
	////echo $CODE;
		$LANG = $_REQUEST["lang"];
		$TASK = $_REQUEST["task"];
	////echo $CODE;
		$sql =
		'INSERT INTO `Submissions` (`ID`,`ContestID`,`TaskID`,`UserID` ,`Code`,`Lang`) VALUES (' .
		'"' . $ID . '","' . $CONTEST . '","' . $TASK . '","' . $USER . '","' . $CODE . '","' . $LANG .
		'");';
		;
		$result = $conn->query($sql);
		echo '<script>window.location = "/queue";</script>';
	}
////include ($_SERVER["DOCUMENT_ROOT"] . "/lib/queue.php");
////print_queue ();
?>
