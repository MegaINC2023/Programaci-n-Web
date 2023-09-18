<?php


$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'login'
) or die(mysqli_erro($mysqli));

?>
<?php

include("config\usersDB.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM usuarios WHERE id = $id";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Task Removed Successfully';
  $_SESSION['message_type'] = 'danger';
  header('Location: signup.php');
}

?>