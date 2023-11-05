<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "megainc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la matrícula del formulario
    $matricula = $_POST["matricula"];

    // Realizar la consulta SQL con la matrícula
    $sql = "SELECT r.id_trayecto, t.id_almacen, t.posicion, a.calle, a.numero, a.localidad
            FROM realiza r
            JOIN tiene t ON r.id_trayecto = t.id_trayecto
            JOIN almacen a ON t.id_almacen = a.id_almacen
            WHERE r.matricula = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matricula);  // "s" indica que se trata de una cadena

    $stmt->execute();
    $result = $stmt->get_result();

    // Mostrar los resultados en una tabla
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID Trayecto</th><th>ID Almacen</th><th>Posición</th><th>Calle</th><th>Número</th><th>Localidad</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_trayecto"] . "</td>";
            echo "<td>" . $row["id_almacen"] . "</td>";
            echo "<td>" . $row["posicion"] . "</td>";
            echo "<td>" . $row["calle"] . "</td>";
            echo "<td>" . $row["numero"] . "</td>";
            echo "<td>" . $row["localidad"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados para la matrícula ingresada.";
    }

    // Cerrar la conexión a la base de datos
    $stmt->close();
    $conn->close();
}
?>
