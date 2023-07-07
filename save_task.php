<?php

include('bd.php');

if (isset($_POST['save_task'])) {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $tipo = $_POST['tipo'];
  $contrasena = $_POST['contrasena'];
  $cedula = $_POST['cedula'];
  $query = "INSERT INTO task(id, nombre, apellido, tipo, contrasena, cedula) VALUES ('$id', '$nombre', '$apellido', '$tipo', '$contrasena', '$cedula')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: index.php');

}

?>