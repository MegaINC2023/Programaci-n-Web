<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
</head>
<body>
<main>
    <form method="POST">
        <label for="id_lote">ID del lote:</label>
        <input type="text" id="id_lote" name="id_lote" placeholder="Escribe el ID del lote">
        <button type="submit">Buscar</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idLote = $_POST["id_lote"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "megainc";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT peso, almacen_destino FROM lote WHERE id_lote = $idLote";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<h2>Información del Lote</h2>";
            echo "<p><strong>Peso:</strong> " . $row["peso"] . "</p>";
            echo "<p><strong>Almacén Destino:</strong> " . $row["almacen_destino"] . "</p>";
        } else {
            echo "No se encontraron resultados para el ID del lote ingresado.";
        }

        $sql = "SELECT id_paquete FROM pertenece WHERE id_lote = $idLote";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h2>Paquetes relacionados</h2>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>ID Paquete: " . $row["id_paquete"] . "</li>";
            }
            echo "</ul>";
        }
        
        $conn->close();
    }
    ?>
</main>
</body>
</html>