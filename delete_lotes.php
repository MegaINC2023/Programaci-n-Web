<?php

include("config\usersDB.php");

if(isset($_GET['id_lotes'])) {
  $id_lotes = $_GET['id_lotes'];
  $query = "DELETE FROM lotes WHERE id_lotes = $id_lotes";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: altaLotes.php');
}

?>