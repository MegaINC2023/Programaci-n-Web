<?php
include("config\usersDB.php");

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['viajar'])) {
    // Obtener valores del formulario (ajusta estos valores según la estructura de tu formulario)
    $id_lote = $_POST['input_id_lote'];
    $id_almacen = $_POST['input_id_almacen'];
    $id_trayecto = $_POST['input_id_trayecto'];
    
    // Consulta de inserción
    $sql = "INSERT INTO viaja (id_lote, id_almacen, id_trayecto, fecha_llegada, hora_llegada) VALUES (?, ?, ?, NOW(), NOW())";
    
    // Preparar la declaración
    $stmt = $conn->prepare($sql);
    
    // Vincular los parámetros
    $stmt->bind_param("iii", $id_lote, $id_almacen, $id_trayecto);  
    
    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Inserción exitosa";
    } else {
        echo "Error en la inserción: " . $stmt->error;
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>