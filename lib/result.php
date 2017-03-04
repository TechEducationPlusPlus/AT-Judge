<?php
	function print_results ()
	{
		$ID = substr ($_SERVER["REQUEST_URI"], 10, -8);
			
		function update ($old, $new)
		{
			return max (intval ($old), intval($new));
		}
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$sql = 'SELECT * FROM `Submissions` WHERE (`ContestID`="' . $ID . '" AND `Points` IS NOT NULL);';
		$result = $conn->query($sql);
		$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/result_template.php'));
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
					$users [$row["UserID"]] = array ();
					$users [$row["UserID"]]["total"] = 0;
				}
				if (!isset ($users [$row["UserID"]][$row["TaskID"]]))
					$users [$row["UserID"]][$row["TaskID"]] = 0;
				
				$users [$row["UserID"]]["total"] = $users [$row["UserID"]]["total"] - $users [$row["UserID"]][$row["TaskID"]];
				
				$users [$row["UserID"]][$row["TaskID"]] = update ($users [$row["UserID"]][$row["TaskID"]], $row["Points"]);

				$users [$row["UserID"]]["total"] = $users [$row["UserID"]]["total"] + $users [$row["UserID"]][$row["TaskID"]];
			
				$nameTask = $conn -> query ("SELECT * FROM `Tasks` WHERE `ID`=" . $row ["TaskID"])->fetch_assoc () ["Name"];
				$tasks [$row["TaskID"]] = $nameTask;
			}
			foreach ($tasks as $key => $value)
				$tableheader = $tableheader . "<th>" . $value . "(" . $key . ")" . "</th>";

			//var_dump ($users);

			function cmp($a, $b)
			{
				return $b['total'] - $a['total'];
			}

			uasort($users, "cmp");
			//var_dump ($users);

			$num = 0;
			foreach ($users as $key => $value)
			{
				$num += 1;
				$table = $table .
					"<tr><td>" . $num . "</td><td>" . $key . "</td>";
				//echo $key;
				foreach ($tasks as $taskkey => $taskname)
				{
					$table = $table . "<td>" . $value[$taskkey] . "</td>";
				}
				$table = $table . "<td>" . $value["total"] . "</td></tr>";
			}
		}
		$tableheader = $tableheader . "<th>Total</th></tr>";
		$table = $tableheader . $table;
		$html_code = str_replace ('{{table}}', $table, $html_code); 
		$html_code = str_replace ('{{cert}}', $table, $html_code); 
		echo $html_code;
		unset($html_code);
	}
?>

