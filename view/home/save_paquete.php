<?php

include('config\usersDB.php');

if (isset($_POST['save_paquete'])) {
  $id_paquete = $_POST['id_paquete'];
  $estado = $_POST['estado'];
  $tipo = $_POST['tipo'];
  $fragil = $_POST['fragil'];
  $query = "INSERT INTO paquete(id_paquete, estado, tipo, fragil) VALUES ('$id_paquete', '$estado', '$tipo', '$fragil')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionPaquete.php');

}

?>