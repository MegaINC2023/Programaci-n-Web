<?php
include("config\usersDB.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener los datos del formulario
    $matricula = $_POST["matricula"];
    $id_paquete = $_POST["id_paquete"];

    // Verificar si ya existe una entrega para este paquete y matricula
    $sqlVerificar = "SELECT matricula, hora_entrega, fecha_entrega FROM entrega WHERE matricula = ? AND id_paquete = ?";
    $stmtVerificar = $conn->prepare($sqlVerificar);
    $stmtVerificar->bind_param("ss", $matricula, $id_paquete);
    $stmtVerificar->execute();
    $stmtVerificar->store_result();

    if ($stmtVerificar->num_rows > 0) {
        $stmtVerificar->bind_result($matricula_result, $hora_entrega, $fecha_entrega);
        $stmtVerificar->fetch();

        // Verificar si hora_entrega y fecha_entrega son nulos
        if ($hora_entrega === null && $fecha_entrega === null) {
            // Actualizar la entrega con los valores de NOW()
            $sqlUpdate = "UPDATE entrega SET hora_entrega = NOW(), fecha_entrega = NOW() WHERE matricula = ? AND id_paquete = ?";
            $stmtUpdate = $conn->prepare($sqlUpdate);
            $stmtUpdate->bind_param("ss", $matricula, $id_paquete);

            if ($stmtUpdate->execute()) {
                // Actualizar el estado del paquete a "Entregado"
                $sqlUpdatePaquete = "UPDATE paquete SET estado = 'Entregado' WHERE id_paquete = ?";
                $stmtUpdatePaquete = $conn->prepare($sqlUpdatePaquete);
                $stmtUpdatePaquete->bind_param("s", $id_paquete);

                if ($stmtUpdatePaquete->execute()) {
                    echo "La entrega del paquete se ha actualizado exitosamente.";
                } else {
                    echo "Error al actualizar el estado del paquete: " . $stmtUpdatePaquete->error;
                }

                $stmtUpdatePaquete->close();
            } else {
                echo "Error al actualizar la entrega del paquete: " . $stmtUpdate->error;
            }

            $stmtUpdate->close();
        } else {
            echo "Este paquete ya ha sido entregado previamente.";
        }
    } else {
        // Inserción en la tabla entrega
        $sqlInsert = "INSERT INTO entrega (matricula, id_paquete, hora_entrega, fecha_entrega) VALUES (?, ?, NOW(), NOW())";
        $stmtInsert = $conn->prepare($sqlInsert);
        $stmtInsert->bind_param("ss", $matricula, $id_paquete);  

        if ($stmtInsert->execute()) {
            // Actualizar el estado del paquete a "Entregado"
            $sqlUpdatePaquete = "UPDATE paquete SET estado = 'Entregado' WHERE id_paquete = ?";
            $stmtUpdatePaquete = $conn->prepare($sqlUpdatePaquete);
            $stmtUpdatePaquete->bind_param("s", $id_paquete);

            if ($stmtUpdatePaquete->execute()) {
                echo "La entrega del paquete se ha registrado y el estado del paquete se ha actualizado a 'Entregado'.";
            } else {
                echo "Error al actualizar el estado del paquete: " . $stmtUpdatePaquete->error;
            }

            $stmtUpdatePaquete->close();
        } else {
            echo "Error al registrar la entrega del paquete: " . $stmtInsert->error;
        }
    }

    // Cerrar la conexión a la base de datos
    $stmtVerificar->close();
    $conn->close();
}
?>