<?php
session_start();
include("config\usersDB.php");

if(isset($_GET['id_empresa'])) {
  $id_empresa = $_GET['id_empresa'];
  $query = "DELETE FROM Empresa WHERE id_empresa = $id_empresa";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se elimino correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionEmpresa.php');
}

?>