<!DOCTYPE html>
<html>
<head>
    <title>Smart Container</title>
</head>
<style>
  h1 {text-align: center;}
  p {text-align: center;}
  table.center
  {
    margin-left: auto; 
    margin-right: auto;
  }
</style>
    <body>
        <h1>Smart Soptunna</h1>
        <p>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1849.0872167159928!2d17.289185216100865!3d62.38994936898131!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46645df558b81fb1%3A0xc5a5ca8dac40b293!2sNorra%20J%C3%A4rnv%C3%A4gsgatan%207%2C%20852%2037%20Sundsvall!5e0!3m2!1ssv!2sse!4v1618747669389!5m2!1ssv!2sse"
           width="500" height="350" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </p>
    <br>
    <br>
    <table border="1" cellspacing="1" cellpadding="5" class="center">
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