<?php

include("config\usersDB.php");

if(isset($_GET['id_almacen'])) {
  $id_almacen = $_GET['id_almacen'];
  $query = "DELETE FROM Almacen WHERE id_almacen = $id_almacen";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionAlmacen.php');
}

?>