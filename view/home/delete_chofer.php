<?php

include("config\usersDB.php");

if(isset($_GET['cedula'])) {
  $cedula = $_GET['cedula'];
  $query = "DELETE FROM chofer WHERE cedula = $cedula";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se elimino correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionChofer.php');
}

?>