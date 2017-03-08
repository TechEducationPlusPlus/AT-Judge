<?php
	function print_contest (string $link)
	{
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/contest_submits.php");
		$id = substr ($link, 10);
		$valid = false;
		$ID = "invalid username or email or password";
		$name = "invalid username or email or password";

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$sql = "SELECT * FROM Contests WHERE `Link`=\"" . $_SERVER["REQUEST_URI"] . "\"";
		$result = $conn->query($sql);

		if ($result->num_rows == 1) 
		{
			$row = $result->fetch_assoc ();
			
			$tasks = json_decode($row["Tasks"], true);
			$taskbar = '<nav class="navbar navbar-static-top navbar-default"><a href="#" class="navbar-brand">Tasks:</a><ul class="nav navbar-nav">';
			$tasksoption = '';
			foreach ($tasks as $key => $value) 
			{
				$taskbar = $taskbar . '<li class="nav-item"><a href="/task.php?id=' . $value . '" role="button">'. $key . '</a></li>';
				$tasksoption = $tasksoption . '<option value="' . $value . '">' . $key . '</option>';
			}
			$taskbar = $taskbar . '</ul></nav>';
			unset ($tasks);
			
			$langs = $row["Langs"];
			
			$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/contest_template.php'));
			if (isset ($_COOKIE["name"]))
				$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
			$html_code = str_replace ('{{email}}', $_COOKIE["email"], $html_code);
			$html_code = str_replace ('{{title}}', $row["Name"], $html_code);
			$html_code = str_replace ('{{tasks}}', $taskbar, $html_code);
			$html_code = str_replace ('{{tasksoption}}', $tasksoption, $html_code);
			$html_code = str_replace ('{{langs}}', $langs, $html_code);
			$html_code = str_replace ('{{contestid}}', $id, $html_code);
			$html_code = str_replace ('{{submits}}', print_submits ($id), $html_code);
			
			echo $html_code;
			unset($conn);
			unset($taskbar);
			unset($tasksoption);
			unset($langs);
			unset($html_code);
			
			return ;
		} 
		else
		{
			echo "Contest not found or ID is not unique";
			return ;
		}
	}
?>
