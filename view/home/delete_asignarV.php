<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['id_lote'])) {
    $id_lote = $_GET['id_lote'];

    
    $delete_realiza_query = "DELETE FROM realiza WHERE id_lote = '$id_lote'";
    $delete_realiza_result = mysqli_query($conn, $delete_realiza_query);

    if ($delete_realiza_result) {
        
        header('Location: gestionVehiculo.php'); 
    } else {
        
        echo "Error al eliminar las asignaciones. Por favor, inténtalo de nuevo.";
    }
} else {
   
    echo "Parámetro 'id_lote' faltante.";
}
?>