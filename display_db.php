<!DOCTYPE html>
<html>
<head>
    <title>Smart Container</title>
</head>
<style>
  h1 {text-align: center;}
  p {text-align: center;}
</style>
    <body>
        <h1>Smart Container Prototyp</h1>
    <table border="1" cellspacing="1" cellpadding="5">
      <tr>
            <td>Mätning</td>
            <td>Procentsats</td>
            <td>Tidpunkt</td>
      </tr>

<?php 

  // Connection details
  $servername = "localhost";
  $username = "";
  $password = "";
  $database = "container";

  // Creates the connection with the specified database
  $conn = mysqli_connect($servername, $username, $password, $database);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve all records from the database
  $sql = 'SELECT * FROM sensor_data ORDER BY id DESC';

  if ($result = $conn-> query ($sql)) {
    // Process every record
    while ($row = $result-> fetch_assoc ()) {
      $row_id = $row ['ID'];
      $row_distance = $row ['Distance'];
      $row_reading_time = $row ['Reading_time'];

      echo '<tr>
              <td>'. $row_id. '</td>
              <td>'. $row_distance. '</td>
              <td>'. $row_reading_time. '</td>
            </tr>';
    } 
    
    $result-> free ();
  } 

  $conn->close();

?> 
</table> 
</body> 
</html>