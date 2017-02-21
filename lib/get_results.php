<?php
	function update ($old, $new)
	{
		return max (intval ($old), intval($new));
	}

	function change ($old, $new)
	{
		return - intval($old) + update ($old, $new);
	}
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$ID = $_REQUEST["id"];

	//get contest information
	{
		$contest = $conn->query('SELECT * FROM `Contests` WHERE `ID`="' . $ID . '"')->fetch_assoc(); 
	}
	
	$sql = 'SELECT * FROM `Submissions` WHERE ContestID="' . $ID . '", Points IS NOT NULL;';
	$result = $conn->query($sql);

	$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/result_template.php'));
	
	if (isset ($_COOKIE["name"]))
		$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
	
	$tableheader = "<tr><th>UserID</th>";
	$table = "";
	$current_contestant = "no submits";
	$max_points = 0;
	if ($result->num_rows > 0) 
	{
		//collect submits
		$users = [];
		$userTotal = [];
		$tasks = [];
		while ($row = $result->fetch_assoc())
		{
			if (!isset ($userTotal[$row["UserID"]]))
				$userTotal [$row["UserID"]] = 0;
			$userTotal [$row["UserID"]] += change ($users [$row["UserID"]][$row["TaskID"]], $row["Points"]);
			$users [$row["UserID"]][$row["TaskID"]] = update (
			$users [$row["UserID"]][$row["TaskID"]], $row["Points"]);
			$tasks [$row["TaskID"]] = $row["TaskID"];
		}

		//sorting
		function cmp($a, $b)
		{
			return $b - $a;
		}

		usort($userTotal, "cmp");

		//generate table header	
		foreach ($tasks as $key => $value)
			$tableheader = $tableheader . "<th>" . $key . "(" . $value . ")" . "</th>";
		//generate table
		foreach ($userTotal as $key => $value)
		{
			$table = $table .
				"<tr><td>" . $row["UserID"] . "</td>";
			if ($_COOKIE["name"] == $row["UserID"])
			{
				$current_contestant = $value;
			}
			foreach ($tasks as $taskkey => $taskname)
			{
				$table = $table . "<td>" . $users[$key][$taskkey] . "</td>";
			}
			$table = $table . "<td>" . $value . "</td></tr>";
		}
	}
	$tableheder = $tableheader . "<th>Total</th></tr>";
	$table = $tableheader . $table;
	if ($contest["Certify"] == 1)
	{

		$table = $table . $certificate;
	}
	$html_code = str_replace ('{{table}}', $table, $html_code); 
	echo $html_code;
	unset($html_code);
?>

