<?php
session_start();
include("config/usersDB.php");

if (isset($_POST['matricula']) && isset($_POST['id_lote']) && isset($_POST['id_trayecto']) && isset($_POST['id_almacen'])) {
    $matricula = $_POST['matricula'];
    $id_lote = $_POST['id_lote'];
    $id_trayecto = $_POST['id_trayecto'];
    $id_almacen = $_POST['id_almacen'];

    // Realiza la inserción en la tabla 'realiza'
    $insert_realiza_query = "INSERT INTO Realiza (matricula, id_lote, id_trayecto, id_almacen) VALUES ('$matricula', '$id_lote', '$id_trayecto', '$id_almacen')";
    $insert_realiza_result = mysqli_query($conn, $insert_realiza_query);

    if ($insert_realiza_result) {
        // La inserción se realizó con éxito
        header('Location: gestionVehiculo.php'); // Redirige a la página de gestión de 'realiza'
    } else {
        // Hubo un error en la inserción
        echo "Error al guardar la asignación. Por favor, inténtalo de nuevo.";
    }
} else {
    // Maneja el caso en el que los parámetros no estén definidos
    echo "Parámetros faltantes.";
}
?>