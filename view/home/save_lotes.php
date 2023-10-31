<?php

include('config\usersDB.php');

if (isset($_POST['save_lotes'])) {
  $id_lote = $_POST['id_lote'];
  $estado = $_POST['estado'];
  $peso = $_POST['peso'];
  $almacen_destino = $_POST['almacen_destino'];
  $query = "INSERT INTO lote(id_lote, estado, peso, almacen_destino) VALUES ('$id_lote', '$estado', '$peso', '$almacen_destino')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionLotes.php');

}

?>