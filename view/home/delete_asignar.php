<?php
include("config/usersDB.php");

if (isset($_GET['id_paquete'])) {
    $id_paquete = $_GET['id_paquete'];

    // Inicia una transacción para asegurar la integridad de los datos
    mysqli_autocommit($conn, false);

    // Intenta eliminar el registro de la tabla "direccion" primero
    $delete_pertenece_query = "DELETE FROM pertenece WHERE id_paquete = $id_paquete";
    $delete_pertenece_result = mysqli_query($conn, $delete_pertenece_query);
}

// Finaliza la transacción y restaura el modo de autocommit
mysqli_autocommit($conn, true);

header('Location: gestionLotes.php');
?>