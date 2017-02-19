<?php
	function update ($old, $new)
	{
		return max (intval ($old), intval($new));
	}
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$ID = $_REQUEST["id"];
	$sql = 'SELECT * FROM `Submissions` WHERE ContestID="' . $ID . '", Points IS NOT NULL;';
	$result = $conn->query($sql);
	$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/result_template.php'));
	if (isset ($_COOKIE["name"]))
		$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
	$tableheader = "<tr><th>UserID</th>";
	$table = "";
	if ($result->num_rows > 0) 
	{
		$users;
		$tasks;
		while ($row = $result->fetch_assoc())
		{
			$users [$row["UserID"]][$row["TaskID"]] = update (
			$users [$row["UserID"]][$row["TaskID"]], $row["Points"]);
			$tasks [$row["TaskID"]] = $row["TaskID"];
		}
		foreach ($tasks as $key => $value)
			$tableheader = $tableheader . "<th>" . $key . "(" . $value . ")" . "</th>";
		foreach ($users as $key => $value)
		{
			$table = $table .
				"<tr><td>" . $row["UserID"] . "</td>";
			$result = 0;
			foreach ($tasks as $taskkey => $taskname)
			{
				$table = $table . "<td>" . $value[$taskkey] . "</td>";
				$result += intval ($value[$taskkey]);
			}
			$table = $table . "<td>" . $result . "</td></tr>";
		}
	}
	$tableheder = $tableheader . "<th>Total</th></tr>";
	$table = $tableheader . $table;
	$html_code = str_replace ('{{table}}', $table, $html_code); 
	echo $html_code;
	unset($html_code);
?>

