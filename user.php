<?php
	$html_code = implode ('', file (__DIR__ . '/user_template.php'));
	if (isset ($_COOKIE["name"]))
		$html_code = str_replace ('Hi', 'Hi, ' . $_COOKIE["name"], $html_code);
	$html_code = str_replace ('{{mail}}', $_COOKIE["email"], $html_code);
	$html_code = str_replace ('{{mail}}', $_COOKIE["email"], $html_code);
	$html_code = str_replace ('{{name}}', $_COOKIE["name"], $html_code);
	echo $html_code;
?>
