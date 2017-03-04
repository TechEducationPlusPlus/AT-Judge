<?php
	function print_cert ()
	{
		function update ($old, $new)
		{
			return max (intval ($old), intval($new));
		}
		include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

		$conn = new MySQL ("judge");
		
		$value = explode('/', substr ($_SERVER["REQUEST_URI"], 13)); 
		
		function get_score ()
		{
				$conn = new MySQL ("judge");
				$value = explode('/', substr ($_SERVER["REQUEST_URI"], 13)); 
				$value[0] = $conn->query ("SELECT * FROM `Users` WHERE `ID`=\"{$value[0]}\"")->fetch_assoc ()["Email"];
				$result = $conn->query ("SELECT * FROM `Submissions` WHERE `Points` IS NOT NULL AND `ContestID`=\"{$value[1]}\" AND `UserID`=\"{$value[0]}\"");
				$users = array ();
				if ($result->num_rows > 0) 
				{
					while ($row = $result->fetch_assoc())
					{
						if (!isset ($users ["total"]))
						{
							$users ["total"] = 0;
						}
						if (!isset ($users [$row["TaskID"]]))
							$users [$row["TaskID"]] = 0;
						
						$users ["total"] = $users ["total"] - $users [$row["TaskID"]];
						
						$users [$row["TaskID"]] = update ($users [$row["TaskID"]], $row["Points"]);

						$users ["total"] = $users ["total"] + $users [$row["TaskID"]];
				
					}
				}
				return intval ($users["total"]);	
		}
		try
		{
			echo str_replace (
					'{{name}}',
					$conn->query ("SELECT * FROM `Users` WHERE `ID`=\"{$value[0]}\"")->fetch_assoc ()["Name"],
					str_replace (
						'{{contest}}',
						$conn->query ("SELECT * FROM `Contests` WHERE `ID`=\"{$value[1]}\"")->fetch_assoc ()["Name"],
						str_replace (
							'{{score}}',
							get_score (),
							str_replace (
								'{{id}}',
								substr ($_SERVER["REQUEST_URI"], 13),
								implode ('', file ($_SERVER["DOCUMENT_ROOT"] . '/lib/active/big_cert.html'))
							)
						)
					)
				);
		}
		catch (Exception $e)
		{
			echo 'Прихванато изключение: ',  $e->getMessage(), "\n";
		}
	}
?>
