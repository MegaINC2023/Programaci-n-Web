<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_asignarC'])) {
  $cedula = $_POST['cedula'];
  $matricula = $_POST['matricula'];
  $query = "INSERT INTO Maneja(cedula, matricula) VALUES ('$cedula', '$matricula')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionChofer.php');

}

?>