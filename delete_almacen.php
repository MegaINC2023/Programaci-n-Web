<?php

include("config\usersDB.php");

if(isset($_GET['id_almacen'])) {
  $id_almacen = $_GET['id_almacen'];
  $query = "DELETE FROM almacen WHERE id_almacen = $id_almacen";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: altaAlmacen.php');
}

?>