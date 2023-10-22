<?php

include("config\usersDB.php");

if(isset($_GET['id_paquete'])) {
  $id_paquete = $_GET['id_paquete'];
  $query = "DELETE FROM paquetes WHERE id_paquete = $id_paquete";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se modifico correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionPaquete.php');
}

?>