<?php
	function print_quiz (string $link)
	{
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/contest_submits.php");
		$id = substr ($link, 10);
		$valid = false;
		$ID = "invalid username or email or password";
		$name = "invalid username or email or password";

		$dbname = "judge";

		$conn = new MySQL ($dbname);

		$sql = "SELECT * FROM Quizes WHERE `Link`=\"" . $_SERVER["REQUEST_URI"] . "\"";
		$result = $conn->query($sql);

		function get_html ($id, $mysql)
		{
			$task = $mysql->query ("SELECT * FROM `QuizTasks` WHERE `ID`=\"{$id}\"")->fetch_assoc ();
			$json = json_decode($task["Options"], true);
			$answer = "";
			foreach ($json as $key => $value)
			{
				$answer = $answer . "
										<label class=\"element-animation1 btn btn-lg btn-primary btn-block\">
											<span class=\"btn-label\">
												<i class=\"fa fa-caret-right\" aria-hidden=\"true\"></i>
											</span>
											<input type=\"radio\" name=\"$id\" value=\"{$key}\">{$value}</input>
										</label>
";
			}
			$output = "
				<div class=\"form-group\">
					<div class=\"container-fluid\">
						<div class=\"modal-dialog\">
							<div class=\"modal-content\">
								<div class=\"modal-header\">
									<h3><span class=\"label label-warning\" id=\"qid\">{$id}</span> {$task ["Question"]}</h3>
								</div>
								<div class=\"modal-body\">
									<div class=\"quiz\" id=\"quiz\" data-toggle=\"buttons\">
										{$answer}
									</div>
								</div>
								<div class=\"modal-footer text-muted\"> <span id=\"hint\">{$task ["Hint"]}</span> </div>
							</div>
						</div>
					</div>
				</div>
";
			return $output;
		}

		if ($result->num_rows == 1) 
		{
			$row = $result->fetch_assoc ();
			
			$tasks = explode(",", $row["Tasks"]);
			$questions = "";

			foreach ($tasks as $id)
			{
				$questions = $questions . get_html($id, $conn);
			}
			
			$langs = $row["Langs"];
			
			$html_code = implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/quiz_template.php'));
			if (isset ($_COOKIE["name"]))
				$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
			$html_code = str_replace ('{{email}}', $_COOKIE["email"], $html_code);
			$html_code = str_replace ('{{title}}', $row["Name"], $html_code);
			$html_code = str_replace ('{{tasks}}', $questions, $html_code);
			$html_code = str_replace ('{{quizid}}', $id, $html_code);
			
			echo $html_code;
			unset($conn);
			unset($html_code);
			
			return ;
		} 
		else
		{
			echo "Quiz not found or ID is not unique";
			return ;
		}
	}
?>
