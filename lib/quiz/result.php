<?php
	function print_quiz_results ()
	{
		$ID = substr ($_SERVER["REQUEST_URI"], 6, -8);
			
		function update ($old, $new)
		{
			return max (intval ($old), intval($new));
		}
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$sql = 'SELECT * FROM `QuizResults` WHERE (`QuizID`="' . $ID . '");';
		$result = $conn->query($sql);
		$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/quiz_result_template.php'));
		if (isset ($_COOKIE["name"]))
			$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
		$tableheader = "<tr><th>Rank</th><th>UserID</th>";
		$table = "";
		if ($result->num_rows > 0) 
		{
			$users = array ();
			$tasks = array ();
			while ($row = $result->fetch_assoc())
			{
				if (!isset ($users [$row["UserID"]]))
				{
					$users [$row["UserID"]] = 0;
				}

				$users [$row["UserID"]] = update ($users [$row["UserID"]], $row["Result"]);
			}

			function cmp($a, $b)
			{
				return $b - $a;
			}

			uasort($users, "cmp");
			//var_dump ($users);

			$num = 0;
			foreach ($users as $key => $value)
			{
				$num += 1;
				$table = $table .
					"<tr><td>" . $num . "</td><td>" . $key . "</td>";
				$table = $table . "<td>" . $value . "</td></tr>";
			}
		}
		$tableheader = $tableheader . "<th>Total</th></tr>";
		$table = $tableheader . $table;
		$html_code = str_replace ('{{table}}', $table, $html_code); 
		$cert = "";
		echo $html_code;
		unset($html_code);
	}
?>

