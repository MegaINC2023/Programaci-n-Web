<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener los datos del formulario
    $matricula = $_POST["matricula"];
    $id_paquete = $_POST["id_paquete"];

    // Configuración de la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "megainc";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Inserción en la tabla entrega
    $sqlInsert = "INSERT INTO entrega (matricula, id_paquete, hora_entrega, fecha_entrega) VALUES (?, ?, NOW(), NOW())";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bind_param("ss", $matricula, $id_paquete);  

    if ($stmtInsert->execute()) {
        // Eliminación de las direcciones relacionadas
        $sqlDeleteDireccion = "DELETE FROM direccion WHERE id_paquete = ?";
        $stmtDeleteDireccion = $conn->prepare($sqlDeleteDireccion);
        $stmtDeleteDireccion->bind_param("s", $id_paquete);

        if ($stmtDeleteDireccion->execute()) {
            
            $sqlDeletePaquete = "DELETE FROM paquete WHERE id_paquete = ?";
            $stmtDeletePaquete = $conn->prepare($sqlDeletePaquete);
            $stmtDeletePaquete->bind_param("s", $id_paquete);

            if ($stmtDeletePaquete->execute()) {
                echo "La entrega del paquete se ha registrado y el paquete se ha eliminado exitosamente.";
            } else {
                echo "Error al eliminar el paquete: " . $stmtDeletePaquete->error;
            }

            $stmtDeletePaquete->close();
        } else {
            echo "Error al eliminar las direcciones relacionadas: " . $stmtDeleteDireccion->error;
        }

        $stmtDeleteDireccion->close();
    } else {
        echo "Error al registrar la entrega del paquete: " . $stmtInsert->error;
    }

    // Cerrar la conexión a la base de datos
    $stmtInsert->close();
    $conn->close();
}
?>
