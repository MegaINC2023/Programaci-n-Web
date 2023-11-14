<?php
session_start();
include("config\usersDB.php");

if(isset($_GET['id_usuario'])) {
  $id_usuario = $_GET['id_usuario'];
  $query = "DELETE FROM login WHERE id_usuario = $id_usuario";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se elimino correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionUsuario.php');
}

?>