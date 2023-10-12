<?php

include('config\usersDB.php');

if (isset($_POST['save_vehiculo'])) {
  $matricula = $_POST['matricula'];
  $estado = $_POST['estado'];
  $licencia = $_POST['licencia'];
  $pesoMax = $_POST['pesoMax'];
  $query = "INSERT INTO Vehiculo(matricula, estado, licencia, pesoMax) VALUES ('$matricula', '$estado', '$licencia', '$pesoMax')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionVehiculo.php');

}

?>