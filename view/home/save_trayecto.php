<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_trayecto'])) {
  $id_trayecto = $_POST['id_trayecto'];
  $origen = $_POST['origen'];
  $destino = $_POST['destino'];
  $distancia = $_POST['distancia'];
  $query = "INSERT INTO Trayecto (origen, destino, distancia) VALUES ('$origen', '$destino', '$distancia')";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionTrayecto.php');

}

?>