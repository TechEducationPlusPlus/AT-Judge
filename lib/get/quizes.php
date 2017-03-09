<?php
	include_once ($_SERVER["DOCUMENT_ROOT"] . "/lib/mysql.php");

	$dbname = "judge";

	$conn = new MySQL ($dbname);

	$sql = "SELECT * FROM Quizes";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
			echo '<div class="col-md-4"><h2 id="' . $row["ID"] . '">' . $row["Name"] . '</h2><br><a href="' . $row["Link"] . '" role="button" class="btn btn-raised btn-success">Compete »</a>' . '<a href="' . $row["Link"] . '/results" role="button" class="btn btn-default active">View results »</a></div>';
		}
	} 
	unset($conn);
?>
