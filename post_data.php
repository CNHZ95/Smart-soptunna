<?php
	include 'connection.php';

	$conn = connect();

	$sql = "INSERT INTO sensor_data (Distance) VALUES ('".$_GET["distance"]."')"; 

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	}
	else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	closeConnection($conn);

?>