<?php
session_start();
include('config\usersDB.php');

if (isset($_POST['save_vehiculo'])) {
  $matricula = $_POST['matricula'];
  $estado = $_POST['estado'];
  $licencia = $_POST['licencia'];
  $peso_max = $_POST['peso_max'];

  $query_vehiculo = '';
  $query_camioneta = '';
  $query_camion = '';

  if (strpos($matricula, 'TM') !== false) {
    // Insertar en vehiculo y camioneta
    $query_vehiculo = "INSERT INTO Vehiculo (matricula, estado, licencia, peso_max) VALUES ('$matricula', '$estado', '$licencia', '$peso_max')";
    mysqli_query($conn, $query_vehiculo);
    
    $query_camioneta = "INSERT INTO Camioneta (matricula, peso_max) VALUES ('$matricula', '$peso_max')";
    mysqli_query($conn, $query_camioneta);
  } else {
    // Insertar en vehiculo y camion
    $query_vehiculo = "INSERT INTO Vehiculo (matricula, estado, licencia, peso_max) VALUES ('$matricula', '$estado', '$licencia', '$peso_max')";
    mysqli_query($conn, $query_vehiculo);

    $query_camion = "INSERT INTO Camion (matricula, peso_max) VALUES ('$matricula', '$peso_max')";
    mysqli_query($conn, $query_camion);
  }
  
  // Verificar si las consultas se ejecutaron correctamente
  if (!$query_vehiculo || (!$query_camioneta && !$query_camion)) {
    die("Query Failed: " . mysqli_error($conn));
  }

  $_SESSION['message'] = 'Se guardó correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionVehiculo.php');
}
?>