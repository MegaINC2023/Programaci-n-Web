<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['id_trayecto']) && isset($_GET['posicion'])) {
    $id_trayecto = $_GET['id_trayecto'];
    $posicion = $_GET['posicion'];

    mysqli_autocommit($conn, false);

    $delete_tiene_query = "DELETE FROM tiene WHERE id_trayecto = '$id_trayecto' AND posicion = '$posicion'";
    $delete_tiene_result = mysqli_query($conn, $delete_tiene_query);

    if ($delete_tiene_result) {
        mysqli_commit($conn);
    } else {
        mysqli_rollback($conn);
    }

    mysqli_autocommit($conn, true);

    header('Location: gestionTrayecto.php');
}
?>