<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['id_paquete'])) {
    $id_paquete = $_GET['id_paquete'];

    
    mysqli_autocommit($conn, false);

    
    $delete_pertenece_query = "DELETE FROM pertenece WHERE id_paquete = $id_paquete";
    $delete_pertenece_result = mysqli_query($conn, $delete_pertenece_query);
}


mysqli_autocommit($conn, true);

header('Location: gestionLotes.php');
?>