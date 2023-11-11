<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="camionero.css">
</head>
<body>
    <header>
        <!-- Logo en la esquina superior izquierda -->
        <img src="aseet/imgs/logo.png" alt="Logo Izquierda" class="logo-izquierda">
        <!-- Logo en la esquina superior derecha -->
        <img src="aseet/imgs/585e4beacb11b227491c3399" alt="Logo Derecha" class="logo-derecha">
        <h1>Página del Camionero</h1>
    </header>
    <main>
    <form method="post" action="camionero.php">
            <label for="matricula">Matrícula del camión:</label>
            <input type="text" id="matricula" name="matricula" placeholder="Escribe la matrícula">
            <button type="submit">Buscar</button>
        </form>


        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $matricula = trim($_POST["matricula"]);

    if (strpos($matricula, "TM") === false) {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "megainc";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Realizar la consulta SQL con la matrícula
        $sql = "SELECT r.id_trayecto, r.id_lote, t.id_almacen, t.posicion, a.calle, a.numero, a.localidad
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
            echo "<h2>Resultados de la búsqueda:</h2>";
            echo "<table>";
            echo "<tr><th>ID Trayecto</th><th>ID Lote</th><th>ID Almacen</th><th>Posición</th><th>Calle</th><th>Número</th><th>Localidad</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id_trayecto"] . "</td>";
                echo "<td>" . $row["id_lote"] . "</td"; 
                echo "<td>" . $row["id_almacen"] . "</td>";
                echo "<td>" . $row["posicion"] . "</td>";
                echo "<td>" . $row["calle"] . "</td>";
                echo "<td>" . $row["numero"] . "</td>";
                echo "<td>" . $row["localidad"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No se encontraron resultados para la matrícula ingresada.</p>";
        }
// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();
       
    } else {
      echo "<h2>Formulario para Entrega de Paquete</h2>";
      echo "<form method='post' action='procesar_entrega.php'>";
      echo "<label for='id_paquete'>ID Paquete:</label>";
      echo "<input type='text' id='id_paquete' name='id_paquete' placeholder='Escribe el ID del paquete'>";
      echo "<input type='hidden' name='matricula' value='$matricula'>"; 
      echo "<button type='submit'>Entregar Paquete</button>";
      echo "</form>";

       
  }
}
?>
        <!-- Resto del contenido -->
    </main>
    <footer>
    <div class="container">

<div class="footer-top section" data-reveal>

  

  <div class="footer-list">

    <p class="h6 has-after">Quick Carry descripcion</p>

    <p class="footer-text">
      
    </p>



      <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
    </a>

  </div>

  <ul class="footer-list">


  <ul class="footer-list">

    <li>
      <p class="h6 has-after">Contacto Rápido</p>
    </li>

    <li>
      <address class="footer-text">
        xxxx xxxxxxxxxxx, xxxxxxxxxxxxxxxxxx.
      </address>
    </li>

    <li>
      <p class="footer-text">
        Sí tienes alguna duda no dudes en llamarnos al telefono que aoarece debajo
      </p>
    </li>

    <li>
      <a href="tel:00201061245741" class="contact-link">XXXXXXXXXXXXX</a>
    </li>

  </ul>

</div>

<div class="footer-bottom">

  <div>

    <p class="copyright">Hecho por Mega, INC.</a></p>
  </div>

  <img src="/src/imgs/MI-fotor-bg-remover-20230525144451.png" width="100" height="63" loading="lazy">

  <ul class="social-list">

    <li>
      <a href="#" class="social-link">
        <ion-icon name="logo-facebook" aria-hidden="true"></ion-icon>
      </a>
    </li>

    <li>
      <a href="#" class="social-link">
        <ion-icon name="logo-twitter" aria-hidden="true"></ion-icon>
      </a>
    </li>

    <li>
      <a href="#" class="social-link">
        <ion-icon name="logo-youtube" aria-hidden="true"></ion-icon>
      </a>
    </li>

    <li>
      <a href="#" class="social-link">
        <ion-icon name="logo-linkedin" aria-hidden="true"></ion-icon>
      </a>
    </li>

  </ul>

</div>

</div>
    </footer>
</body>
</html>
