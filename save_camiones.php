<?php

include('config\usersDB.php');

if (isset($_POST['save_camiones'])) {
  $matricula = $_POST['matricula'];
  $estado = $_POST['estado'];
  $pesoMax = $_POST['pesoMax'];
  $query = "INSERT INTO camion(matricula, estado, pesoMax) VALUES ('$matricula', '$estado', '$pesoMax')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: altaCamion.php');

}

?>