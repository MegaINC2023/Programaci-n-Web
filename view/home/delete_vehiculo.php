<?php
session_start();
include("config\usersDB.php");

if(isset($_GET['matricula'])) {
  $matricula = $_GET['matricula'];

  if (strpos($matricula, 'TM') !== false) {
    
    $query1 = "DELETE FROM Camioneta WHERE matricula = '$matricula'";
    $query2 = "DELETE FROM Vehiculo WHERE matricula = '$matricula'";
    
    $result1 = mysqli_query($conn, $query1);
    $result2 = mysqli_query($conn, $query2);

    if(!$result1 || !$result2) {
      die("Query Failed: " . mysqli_error($conn)); 
    }
  } else {

    
    
    $query5 = "DELETE FROM Realiza WHERE matricula = '$matricula'";
    $query3 = "DELETE FROM Camion WHERE matricula = '$matricula'";
    $query4 = "DELETE FROM Vehiculo WHERE matricula = '$matricula'";
    
    
    
    $result5 = mysqli_query($conn, $query5);
    $result3 = mysqli_query($conn, $query3);
    $result4 = mysqli_query($conn, $query4);
   
    

    if(!$result3 || !$result4 || !$result5) {
      die("Query Failed: " . mysqli_error($conn)); 
    }
  }

  $_SESSION['message'] = 'Se eliminó correctamente';
  $_SESSION['message_type'] = 'danger';
  header('Location: gestionVehiculo.php');
}
?>