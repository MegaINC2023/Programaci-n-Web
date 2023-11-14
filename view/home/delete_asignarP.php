<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['matricula']) && isset($_GET['id_paquete'])) {
    $matricula = $_GET['matricula'];
    $id_paquete = $_GET['id_paquete'];

    mysqli_autocommit($conn, false);

    $delete_entrega_query = "DELETE FROM entrega WHERE matricula = '$matricula' AND id_paquete = '$id_paquete'";
    $delete_entrega_result = mysqli_query($conn, $delete_entrega_query);

    if ($delete_entrega_result) {
        mysqli_commit($conn);
        $_SESSION['message'] = 'Se eliminó correctamente el paquete';
        $_SESSION['message_type'] = 'success';
    } else {
        mysqli_rollback($conn);
        $_SESSION['message'] = 'Error al eliminar el paquete';
        $_SESSION['message_type'] = 'danger';
    }

    mysqli_autocommit($conn, true);

    header('Location: gestionVehiculo.php');
}
?>