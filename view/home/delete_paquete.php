<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['id_paquete'])) {
    $id_paquete = $_GET['id_paquete'];

    mysqli_autocommit($conn, false);

    
    $delete_direccion_query = "DELETE FROM Direccion WHERE id_paquete = $id_paquete";
    $delete_direccion_result = mysqli_query($conn, $delete_direccion_query);

    
    $delete_paquete_query = "DELETE FROM Paquete WHERE id_paquete = $id_paquete";
    $delete_paquete_result = mysqli_query($conn, $delete_paquete_query);

    if ($delete_direccion_result && $delete_paquete_result) {
       
        mysqli_commit($conn);
        $_SESSION['message'] = 'Registros eliminados correctamente';
        $_SESSION['message_type'] = 'danger';
    } else {
        
        mysqli_rollback($conn);
        $_SESSION['message'] = 'Error al eliminar registros';
        $_SESSION['message_type'] = 'danger';
    }

    
    mysqli_autocommit($conn, true);

    header('Location: gestionPaquete.php');
}
?>