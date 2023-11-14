<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_asignarP'])) {
  $id_paquete = $_POST['id_paquete'];
  $matricula = $_POST['matricula'];
  $query = "INSERT INTO entrega(id_paquete, matricula) VALUES ('$id_paquete', '$matricula')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionVehiculo.php');

}

?>