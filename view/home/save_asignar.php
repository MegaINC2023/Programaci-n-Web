<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_asignar'])) {
  $id_lote = $_POST['id_lote'];
  $id_paquete = $_POST['id_paquete'];
  $query = "INSERT INTO Pertenece(id_paquete, id_lote) VALUES ('$id_paquete', '$id_lote')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionLotes.php');

}

?>