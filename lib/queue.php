<?php
	function print_queue ()
	{
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$sql = "SELECT * FROM `Submissions` WHERE `Points` IS NULL";
		$result = $conn->query($sql);

		echo "Test";
		$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/queue_template.php'));
		if (isset ($_COOKIE["name"]))
			$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);

		$table =
		'<div class="table-responsive"> <table class="table">'.
		'<tr><th>ID</th><th>ContestID</th><th>TaskID</th><th>UserID</th><th>Code</th><th>Language</th><th>Points</th></tr>';

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$table = $table .
				'<tr><td>' . $row["ID"] . '</td><td>' . $row["ContestID"] . '</td><td>' . $row["TaskID"] . '</td><td>' . $row ["UserID"] . '</td><td>Source code</td><td>'. $row ["Lang"] . '</td><td>' . $row["Points"] . '</td></tr>';
			}
		} 
		$table = $table .
		'</table></div>';
		$html_code = str_replace ('{{table}}', $table, $html_code);
		echo $html_code;
		unset($conn);
		unset($html_code);
		unset($table);
		return;
	}
?>
