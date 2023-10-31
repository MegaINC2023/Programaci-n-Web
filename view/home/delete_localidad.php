<?php

include("config\usersDB.php");

if(isset($_GET['localidad'])) {
  $localidad = $_GET['localidad'];
  $query = "DELETE FROM localidad WHERE localidad = '$localidad'";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se elimino correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionLocalidad.php');
}

?>