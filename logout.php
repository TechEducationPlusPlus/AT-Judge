<?php
	if (isset ($_COOKIE["name"])) 
	{
		unset($_COOKIE["name"]);
		setcookie("name", "", time() - 3600, '/'); // empty value and old timestamp
	}
	if (isset ($_COOKIE["email"])) 
	{
		unset($_COOKIE["email"]);
		setcookie("email", "", time() - 3600, '/'); // empty value and old timestamp
	}
	
	header('location: /index.php');
?>
