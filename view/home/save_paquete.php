<?php
session_start();
include("config/usersDB.php");

if (isset($_POST['save_paquete'])) {
    // Recopilamos los datos del formulario
    $estado = $_POST['estado'];
    $tipo = $_POST['tipo'];
    $fragil = $_POST['fragil'];
    $calle = $_POST['calle'];
    $numero = $_POST['numero'];
    $localidad = $_POST['localidad'];

    // Creamos un registro en la tabla "paquete"
    $query = "INSERT INTO Paquete (estado, tipo, fragil, fecha_registro) VALUES ('$estado', '$tipo', '$fragil', NOW())";
    mysqli_query($conn, $query);

    // Obtenemos el ID del paquete recién insertado
    $id_paquete = mysqli_insert_id($conn);

    // Creamos un registro en la tabla "direccion" relacionado con el mismo ID del paquete
    $query = "INSERT INTO Direccion (id_paquete, calle, numero, localidad) VALUES ('$id_paquete', '$calle', '$numero', '$localidad')";
    mysqli_query($conn, $query);

    // Redireccionamos o mostramos un mensaje de éxito
    $_SESSION['message'] = 'Paquete guardado exitosamente';
    $_SESSION['message_type'] = 'success';

    header('Location: gestionPaquete.php'); // Cambia "index.php" a la página a la que desees redirigir después de guardar.
}
?>