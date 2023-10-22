<?php
include('config\usersDB.php');

if (isset($_POST['save_vehiculo'])) {
  $matricula = $_POST['matricula'];
  $estado = $_POST['estado'];
  $licencia = $_POST['licencia'];
  $peso_max = $_POST['peso_max'];
  if (strpos($matricula, 'HTP') === 0) {
    // Insertar en vehiculo y camioneta
    $query = "INSERT INTO Vehiculo (matricula, estado, licencia, peso_max) VALUES ('$matricula', '$estado', '$licencia', '$peso_max')";
    mysqli_query($conn, $query);
    
    $query_camioneta = "INSERT INTO Camioneta (matricula, peso_max) VALUES ('$matricula', '$peso_max')";
    mysqli_query($conn, $query_camioneta);
  } else {
    // Insertar en vehiculo y camion
    $query = "INSERT INTO Vehiculo (matricula, estado, licencia, peso_max) VALUES ('$matricula', '$estado', '$licencia', '$peso_max')";
    mysqli_query($conn, $query);

    $query_camion = "INSERT INTO Camion (matricula, peso_max) VALUES ('$matricula', '$peso_max')";
    mysqli_query($conn, $query_camion);
  }
  
  // Check if the queries were executed successfully
  if (!$query_camioneta && !$query_camion) {
    die("Query Failed.");
  }

  $_SESSION['message'] = 'Se guardo correctamente';
  $_SESSION['message_type'] = 'success';
  header('Location: gestionVehiculo.php');
}
?>
