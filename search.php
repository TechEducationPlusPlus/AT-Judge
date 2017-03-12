<?php

	$users = $conn->query ("SELECT * FROM `Users` WHERE `Name` LIKE \"%{$_REQUEST["pattern"]}%\"")

	$contests = $conn->query ("SELECT * FROM `Contests` WHERE `Tasks` LIKE \"%{$_REQUEST["pattern"]}%\" OR `Name` LIKE \"%{$_REQUEST["pattern"]}%\"");

	$quizes = $conn->query ("SELECT * FROM `Quizes` WHERE `Name` LIKE \"%{$_REQUEST["pattern"]}%\"");


?>
