<?php
include("config\usersDB.php");

if(isset($_GET['matricula'])) {
  $matricula = $_GET['matricula'];
  $query = "DELETE FROM Vehiculo WHERE matricula = '$matricula'";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed: " . mysqli_error($conn)); // Display the specific error for debugging.
  }

  $_SESSION['message'] = 'Se eliminó correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionVehiculo.php');
}
?>