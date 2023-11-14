<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_localidad'])) {
  $localidad = $_POST['localidad'];
  $departamento = $_POST['departamento'];
  $query = "INSERT INTO localidad(localidad, departamento) VALUES ('$localidad', '$departamento')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionLocalidad.php');

}

?>