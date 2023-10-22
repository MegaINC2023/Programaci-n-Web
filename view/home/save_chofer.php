<?php

include('config\usersDB.php');

if (isset($_POST['save_chofer'])) {
  $cedula = $_POST['cedula'];
  $licencia = $_POST['licencia'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $query = "INSERT INTO chofer(cedula, licencia, nombre, apellido) VALUES ('$cedula', '$licencia', '$nombre', '$apellido')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionChofer.php');

}

?>