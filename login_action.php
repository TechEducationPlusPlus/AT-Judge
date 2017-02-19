<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");
    $valid = false;
	$ID = "invalid username or email or password";
	$number = "invalid username or email or password";
	$name = "invalid username or email or password";
	$email = "invalid username or email or password";

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$sql = "SELECT * FROM Users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			if ($row["Username"] == $_REQUEST["ID"] || $row["Email"] == $_REQUEST["ID"])
			{
				$name = $row["Name"];
				$email = $row["Email"];
				$ID = $row["Username"];
				$number = $row["ID"];
				$valid = ($row["Password"] == md5($_REQUEST["Password"]));
				break;
			}
			//echo $row["ID"] . " " . $row["Username"]. " " . $row["Password"] . " " . $row["Email"] . " ". $row["Name"] . "<br>";
		}
	} 
	unset($conn);

	if ($valid)
    {
        setcookie("name", $name, time() + (86400 * 30), "/");
        setcookie("email", $email, time() + (86400 * 30), "/");
        setcookie("username", $ID, time() + (86400 * 30), "/");
        setcookie("ID", $number, time() + (86400 * 30), "/");
        header('location: /index.php');
    }
    else
    {
        header("location: /login.php?type=fail");
    }
?>
