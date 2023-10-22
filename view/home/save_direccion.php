<?php

include('config\usersDB.php');

if (isset($_POST['save_paquete'])) {
  $id_paquete = $_POST['id_paquete'];
  $estado = $_POST['estado'];
  $nomb_calle = $_POST['nomb_calle'];
  $num_calle = $_POST['num_calle'];
  $departamento = $_POST['departamento'];
  $localidad = $_POST['localidad'];
  $query = "INSERT INTO paquetes(id_paquete, estado, nomb_calle, num_calle, departamento, localidad) VALUES ('$id_paquete', '$estado', '$nomb_calle', '$num_calle', '$departamento', '$localidad')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionPaquete.php');

}

?>