<?php
session_start();
include("config\usersDB.php");

if(isset($_GET['id_trayecto'])) {
  $id_trayecto = $_GET['id_trayecto'];
  $query = "DELETE FROM Trayecto WHERE id_trayecto = $id_trayecto";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionTrayecto.php');
}

?>