<?php

	// Connection details
	$servername = "localhost";
	$username = "";
	$password = "";
	$database = "container";

	 // Creates the connection with the specified database
	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

	$sql = "INSERT INTO sensor_data (Distance) VALUES ('".$_GET["distance"]."')"; 

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	}
	else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

    $conn->close();

?>
