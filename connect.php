<?php

	function connect() {
		// Connection details
		$servername = "localhost";
		$username = "arduino";
		$password = "IPP2021";
		$database = "container"; // Database name

		 // Creates connection with the specified database
		$conn = mysqli_connect($servername, $username, $password, $database);

		// Check connection
		if ($conn->connect_error) {
		  die("Connection failed: " . $conn->connect_error);
		}

		return $conn;
	}

	function closeConnection($conn) {
		$conn->close();
	}

?>