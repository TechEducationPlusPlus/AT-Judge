<?php
	function print_results (string $link)
	{
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");
		$id = substr ($link, 10, -8);

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$sql = "SELECT * FROM `Submissions` WHERE `ContestID`=" . $id;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{
				$html_code = implode ('', file (__DIR__ . '/contest_template.php'));
				if (isset ($_COOKIE["name"]))
					$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
				$html_code = str_replace ('{{email}}', $_COOKIE["email"], $html_code);
				$html_code = str_replace ('{{title}}', $row["Name"], $html_code);
				$html_code = str_replace ('{{tasks}}', $taskbar, $html_code);
				$html_code = str_replace ('{{tasksoption}}', $tasksoption, $html_code);
				$html_code = str_replace ('{{langs}}', $langoption, $html_code);
				
				echo $html_code;
			}
		} 
		unset($conn);
		return;
	}
?>
