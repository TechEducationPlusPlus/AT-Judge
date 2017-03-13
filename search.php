<?php

	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$users = $conn->query ($sql = "SELECT * FROM `Users` WHERE `Name` LIKE \"%{$_REQUEST["pattern"]}%\"");
	//echo $sql;
	//echo "<br>";

	$contests = $conn->query ($sql = "SELECT * FROM `Contests` WHERE `Tasks` LIKE \"%{$_REQUEST["pattern"]}%\" OR `Name` LIKE \"%{$_REQUEST["pattern"]}%\"");
	//echo $sql;
	//echo "<br>";

	$quizes = $conn->query ($sql = "SELECT * FROM `Quizes` WHERE `Name` LIKE \"%{$_REQUEST["pattern"]}%\"");
	//echo $sql;
	//echo "<br>";

	$users_html = "";
	while ($users->num_rows > 0 and $row = $users->fetch_assoc ())
	{
		$users_html = $users_html . "<div class=\"col-md-4\"><h2 id=\"{$row["ID"]}\">{$row["Name"]}</h2></div>";
	}

	$contests_html = "";
	while ($contests->num_rows > 0 and $row = $contests->fetch_assoc ())
	{
		$contests_html = $contests_html . "<div class=\"col-md-4\"><h2 id=\"{$row["ID"]}\">{$row ["Name"]}</h2><span data-toggle=\"tooltip\" data-placement=\"left\" title=\"Is this constest for a certificate?\" data-original-title=\"Is this constest for a certificate?\"><i class=\"fa fa-trophy\" aria-hidden=\"true\"></i> " . (($row["Certify"] == 0)?"No":"Yes") . "<br><a href=\"{$row["Link"]}\" role=\"button\" class=\"btn btn-raised btn-success\">Compete »</a><a href=\"{$row["Link"]}/results\" role=\"button\" class=\"btn btn-default active\">View results »</a></span></div>";
	}

	$quizes_html = "";
	while ($quizes->num_rows > 0 and $row = $quizes->fetch_assoc ())
	{
		$quizes_html = $quizes_html . "<div class=\"col-md-4\"><h2 id=\"{$row["ID"]}\">{$row ["Name"]}</h2><br><a href=\"{$row["Link"]}\" role=\"button\" class=\"btn btn-raised btn-success\">Compete »</a><a href=\"{$row["Link"]}/results\" role=\"button\" class=\"btn btn-default active\">View results »</a></span></div>";
	}

	if ($contests_html == "")
		$contests_html = "There are no contests with this pattern";
	if ($quizes_html == "")
		$quizes_html = "There are no quizes with this pattern";
	if ($users_html == "")
		$users_html = "There are no users with this pattern";

	echo 
		str_replace (
			"{{contests}}",
			$contests_html,
			str_replace (
				"{{users}}",
				$users_html,
				str_replace (
					"{{quizes}}",
					$quizes_html,
					file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/lib/search_template.php")
				)
			)
		);

?>
