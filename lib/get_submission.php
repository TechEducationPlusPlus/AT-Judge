<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$ID = $_REQUEST["id"];
	$sql = 'SELECT * FROM `Submissions` WHERE ID="' . $ID . '";';
	$result = $conn->query($sql);
	if ($result->num_rows == 1) 
	{
		$row = $result->fetch_assoc();
		$html_code = implode ('', file (__DIR__ . '/submit_template.php'));
		if (isset ($_COOKIE["name"]))
			$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
		$html_code = str_replace ('{{ID}}', $ID, $html_code);
		$html_code = str_replace ('{{source}}', htmlentities(urldecode ($row["Code"])), $html_code);
		$html_code = str_replace ('{{info}}', 
		"<td>" . $ID . "</td><td>" . $row["ContestID"] . "</td><td>" . $row["TaskID"] . "</td><td>" . $row["UserID"] . "</td><td>" . $row["Lang"] . "</td><td>" . $row["Points"] . "</td>", $html_code);
		$html_code = str_replace ('{{lang}}', $row["Lang"], $html_code);
		$html_code = str_replace ('{{compile}}', urldecode ($row["CompileLog"]), $html_code);
		$testByTest = json_decode($row["Log"], true);
		$table = "<tr><th>Test</th><th>Log</th><th>Points</th></tr>";
		foreach ($testByTest as $key => $value) {
			$key = $key + 1;
			if ($value [0] == "WA")
				$value [0] = "Wrong Answer";
			else if ($value [0] == "11")
				$value [0] = "Killed by signal 11";
			$table = $table . "<tr><td>{$key}</td><td>{$value [0]}</td><td>{$value [1]}</td></tr>";
		}

		$html_code = str_replace ('{{tests}}', '<div class="table-responsive"><table class="table">'. $table . '</table></div>', $html_code);

		echo $html_code;
		unset($html_code);
	}
	else
	{
		echo "Error: ID doesn't exist ot isn't unique!";
	}
?>
