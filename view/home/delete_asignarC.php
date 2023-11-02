<?php
include("config/usersDB.php");

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    mysqli_autocommit($conn, false);

    // Intenta eliminar el registro de la tabla "maneja" relacionado con la matrícula
    $delete_maneja_query = "DELETE FROM maneja WHERE matricula = '$matricula'";
    $delete_maneja_result = mysqli_query($conn, $delete_maneja_query);

    if ($delete_maneja_result) {
        mysqli_commit($conn); // Confirma la eliminación
    } else {
        mysqli_rollback($conn); // Deshace la eliminación en caso de error
    }

    mysqli_autocommit($conn, true); // Restablece la configuración de autocommit

    header('Location: gestionChofer.php');
}
?>