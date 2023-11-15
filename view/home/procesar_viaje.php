<?php
session_start();
include("config\usersDB.php");


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['viajar'])) {
    
    $id_lote = $_POST['input_id_lote'];
    $id_almacen = $_POST['input_id_almacen'];
    $id_trayecto = $_POST['input_id_trayecto'];
    
    $sql = "INSERT INTO Viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) VALUES (?, ?, ?, NOW(), NOW())";
   
    $stmt = $conn->prepare($sql);
    
    
    $stmt->bind_param("iii", $id_lote, $id_almacen, $id_trayecto);  
    
    
    if ($stmt->execute()) {
        echo "Inserción exitosa";
    } else {
        echo "Error en la inserción: " . $stmt->error;
    }

    
    $stmt->close();
}


$conn->close();
?>