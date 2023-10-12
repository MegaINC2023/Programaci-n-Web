<?php

include('config\usersDB.php');

if (isset($_POST['save_almacen'])) {
  $id_almacen = $_POST['id_almacen'];
  $empresa = $_POST['empresa'];
  $nomb_calle = $_POST['nomb_calle'];
  $num_calle = $_POST['num_calle'];
  $localidad = $_POST['localidad'];
  $query = "INSERT INTO almacen(id_almacen, empresa, nomb_calle, num_calle, localidad) VALUES ('$id_almacen', '$empresa', '$nomb_calle', '$num_calle', '$localidad')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionAlmacen.php');

}

?>