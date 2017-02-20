<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$sql = "SELECT * FROM Contests";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			echo '<div class="col-md-4"><h2 id=' . $row["ID"] . '>' . $row["Name"] . '</h2><p><a href="' . $row["Link"] . '" role="button" class="btn btn-raised btn-success">Compete »</a></p>' . '<p><a href="' . $row["Link"] . '/results" role="button" class="btn btn-default active">View results »</a></p></div>';
		}
	} 
	unset($conn);
?>
