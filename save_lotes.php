<?php

include('config\usersDB.php');

if (isset($_POST['save_lotes'])) {
  $id_lotes = $_POST['id_lotes'];
  $estado = $_POST['estado'];
  $peso = $_POST['peso'];
  $query = "INSERT INTO lotes(id_lotes, estado, peso) VALUES ('$id_lotes', '$estado', '$peso')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Saved Successfully';
  $_SESSION['message_type'] = 'success';
  header('Location: altaLotes.php');

}

?>