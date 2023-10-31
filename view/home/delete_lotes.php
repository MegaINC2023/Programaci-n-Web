<?php
include("config/usersDB.php");

if (isset($_GET['id_lote'])) {
    $id_lote = $_GET['id_lote'];

    // Inicia una transacción para asegurar la integridad de los datos
    mysqli_autocommit($conn, false);

    // Intenta eliminar el registro de la tabla "direccion" primero
    $delete_pertenece_query = "DELETE FROM pertenece WHERE id_lote = $id_lote";
    $delete_pertenece_result = mysqli_query($conn, $delete_pertenece_query);

    // Luego, elimina el registro de la tabla "paquete"
    $delete_lote_query = "DELETE FROM lote WHERE id_lote = $id_lote";
    $delete_lote_result = mysqli_query($conn, $delete_lote_query);

    if ($delete_pertenece_result && $delete_lote_result) {
        // Si ambos DELETE fueron exitosos, confirma la transacción
        mysqli_commit($conn);
        $_SESSION['message'] = 'Registros eliminados correctamente';
        $_SESSION['message_type'] = 'danger';
    } else {
        // Si alguno de los DELETE falló, revierte la transacción y muestra un mensaje de error
        mysqli_rollback($conn);
        $_SESSION['message'] = 'Error al eliminar registros';
        $_SESSION['message_type'] = 'danger';
    }

    // Finaliza la transacción y restaura el modo de autocommit
    mysqli_autocommit($conn, true);

    header('Location: gestionLotes.php');
}
?>