<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$ID = $_REQUEST["id"];
	$sql = 'SELECT * FROM `Tasks` WHERE `ID`=' . $ID;
	$result = $conn->query ($sql);
	$row = $result->fetch_assoc ();
	echo '<script>window.location = "'. $row["DescriptionLink"] . '";</script>';
?>
