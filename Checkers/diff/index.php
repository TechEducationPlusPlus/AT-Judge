<?php
if ($_REQUEST["type"] == "diff")
{
	if (shell_exec("diff -w <(curl {$_REQUEST["link"]}{$_REQUEST["output1"]}) <(curl {$_REQUEST["link"]}{$_REQUEST["output2"]})") == "")
	{
		echo "[\"OK\", 1]";
	}
	else
	{
		echo "[\"WA\", 0]";
	}
	return true;
}
?>
