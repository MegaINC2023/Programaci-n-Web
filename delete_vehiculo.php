<?php

include("config\usersDB.php");

if(isset($_GET['matricula'])) {
  $matricula = $_GET['matricula'];
  $query = "DELETE FROM Vehiculo WHERE matricula = $matricula";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se elimiino correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionVehiculo.php');
}

?>