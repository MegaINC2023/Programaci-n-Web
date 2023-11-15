<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_asignarT'])) {
  $id_trayecto = $_POST['id_trayecto'];
  $id_almacen = $_POST['id_almacen'];
  $posicion = $_POST['posicion'];
  $query = "INSERT INTO Tiene(id_trayecto, id_almacen, posicion) VALUES ('$id_trayecto', '$id_almacen', '$posicion')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionTrayecto.php');

}

?>