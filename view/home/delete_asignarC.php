<?php
session_start();
include("config/usersDB.php");

if (isset($_GET['matricula'])) {
    $matricula = $_GET['matricula'];

    mysqli_autocommit($conn, false);

    $delete_maneja_query = "DELETE FROM maneja WHERE matricula = '$matricula'";
    $delete_maneja_result = mysqli_query($conn, $delete_maneja_query);

    if ($delete_maneja_result) {
        mysqli_commit($conn); 
    } else {
        mysqli_rollback($conn); 
    }

    mysqli_autocommit($conn, true); 

    header('Location: gestionChofer.php');
}
?>