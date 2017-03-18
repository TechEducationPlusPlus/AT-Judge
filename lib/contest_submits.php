<?php
	function points ($point)
	{
		if (!is_null ($point))
			return (string)$point;
		else
			return "evaluating...";
	}
	function print_submits (string $ContestID)
	{
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$table =
		'<div class="table-responsive"> <table class="table">' .
		'<tr><th>ID</th><th>Task</th><th>Code</th><th>Language</th><th>Points</th></tr>';

		$sql = "SELECT * FROM `Submissions` WHERE (`UserID`='" . $_COOKIE["email"] . "' AND `ContestID`='" . $ContestID . "' AND `Points` IS NULL) ORDER BY (`ID` + 0) DESC";
		$result = $conn->query($sql);
		//echo $sql;
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$table = $table .
				'<tr><td>' . $row["ID"] . '</td><td>' . $conn->query ("SELECT * FROM `Tasks` WHERE `ID`=" . $row ["TaskID"])->fetch_assoc ()["Name"] . '</td><td><a href="/submit/' . $row["ID"] . '">Source code</a></td><td>'. $row ["Lang"] . '</td><td>' . points ($row["Points"]) . '</td></tr>';
			}
		} 

		$sql = "SELECT * FROM `Submissions` WHERE (`UserID`='" . $_COOKIE["email"] . "' AND `ContestID`='" . $ContestID . "' And `Points` IS NOT NULL) ORDER BY (`ID` + 0) DESC";
		$result = $conn->query($sql);
		//echo $sql;
		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$table = $table .
				'<tr><td>' . $row["ID"] . '</td><td>' . $conn->query ("SELECT * FROM `Tasks` WHERE `ID`=" . $row ["TaskID"])->fetch_assoc ()["Name"] . '</td><td><a href="/submit/' . $row["ID"] . '">Source code</a></td><td>'. $row ["Lang"] . '</td><td>' . points ($row["Points"]) . '</td></tr>';
			}
		} 
		$table = $table .
		'</table></div>';
		unset($conn);
		return $table;
	}
?>
