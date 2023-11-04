<?php
include("config/usersDB.php");

if (isset($_GET['id_lote'])) {
    $id_lote = $_GET['id_lote'];

    // Realiza la eliminación en la tabla 'realiza' basado en el id_lote
    $delete_realiza_query = "DELETE FROM realiza WHERE id_lote = '$id_lote'";
    $delete_realiza_result = mysqli_query($conn, $delete_realiza_query);

    if ($delete_realiza_result) {
        // La eliminación se realizó con éxito
        header('Location: gestionVehiculo.php'); // Redirige a la página de gestión de 'realiza'
    } else {
        // Hubo un error en la eliminación
        echo "Error al eliminar las asignaciones. Por favor, inténtalo de nuevo.";
    }
} else {
    // Maneja el caso en el que los parámetros no estén definidos
    echo "Parámetro 'id_lote' faltante.";
}
?>