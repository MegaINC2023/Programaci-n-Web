<?php
include("config/usersDB.php");

if (isset($_GET['id_paquete'])) {
    $id_paquete = $_GET['id_paquete'];

    // Inicia una transacción para asegurar la integridad de los datos
    mysqli_autocommit($conn, false);

    // Intenta eliminar el registro de la tabla "direccion" primero
    $delete_direccion_query = "DELETE FROM direccion WHERE id_paquete = $id_paquete";
    $delete_direccion_result = mysqli_query($conn, $delete_direccion_query);

    // Luego, elimina el registro de la tabla "paquete"
    $delete_paquete_query = "DELETE FROM paquete WHERE id_paquete = $id_paquete";
    $delete_paquete_result = mysqli_query($conn, $delete_paquete_query);

    if ($delete_direccion_result && $delete_paquete_result) {
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

    header('Location: gestionPaquete.php');
}
?>