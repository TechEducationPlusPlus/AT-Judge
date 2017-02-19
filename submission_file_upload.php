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
	$CODE = urlencode (file_get_contents ($_FILES['uploadedfile']['tmp_name'])); 
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
?>
