<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['id_lote'])) {
    $id_lote = $_GET['id_lote'];


    mysqli_autocommit($conn, false);

    
    $delete_pertenece_query = "DELETE FROM pertenece WHERE id_lote = $id_lote";
    $delete_pertenece_result = mysqli_query($conn, $delete_pertenece_query);

    
    $delete_lote_query = "DELETE FROM lote WHERE id_lote = $id_lote";
    $delete_lote_result = mysqli_query($conn, $delete_lote_query);

    if ($delete_pertenece_result && $delete_lote_result) {
        
        mysqli_commit($conn);
        $_SESSION['message'] = 'Registros eliminados correctamente';
        $_SESSION['message_type'] = 'danger';
    } else {
       
        mysqli_rollback($conn);
        $_SESSION['message'] = 'Error al eliminar registros';
        $_SESSION['message_type'] = 'danger';
    }

    
    mysqli_autocommit($conn, true);

    header('Location: gestionLotes.php');
}
?>