<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_usuario'])) {
  $id_usuario = $_POST['id_usuario'];
  $cedula = $_POST['cedula'];
  $contraseña = $_POST['contraseña'];
  $hashed_password = password_hash($contraseña, PASSWORD_DEFAULT);
  $tipo_de_usuario = $_POST['tipo_de_usuario'];
  $query = "INSERT INTO login(id_usuario, cedula, contraseña, tipo_de_usuario) VALUES ('$id_usuario', '$cedula', '$hashed_password', '$tipo_de_usuario')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionUsuario.php');

}

?>