<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_almacen'])) {
  $id_almacen = $_POST['id_almacen'];
  $id_empresa = $_POST['id_empresa'];
  $calle = $_POST['calle'];
  $numero = $_POST['numero'];
  $localidad = $_POST['localidad'];
  $query = "INSERT INTO Almacen(id_almacen, id_empresa, calle, numero, localidad) VALUES ('$id_almacen', '$id_empresa', '$calle', '$numero', '$localidad')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionAlmacen.php');

}

?>