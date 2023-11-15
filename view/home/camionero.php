<?php
session_start();


if (empty($_SESSION['usuario']) || $_SESSION['tipo_usuario'] !== 'chofer') {
    header("Location: acceso_denegado.php");
    exit(); 
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../asset/css/seguimiento.css">

</head>
<body>
<?php
include("config\usersDB.php");


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!empty($_SESSION['usuario'])) {
    
    echo '<header>';
    echo ' <header class="header" data-header>';
    echo  '<div class="container">';
    echo  '<a href="../index.php" class="logo">';
    echo  '<img src="../asset/imgs/logo.png" width="160" height="50" alt="nel home">';
    echo  ' </a>';
    echo  '<nav class="navbar" data-navbar>';
    echo  '<ul class="navbar-list">';
    echo  '<li class="navbar-item">';
    echo  '<a >Página de Chofer</a>';
    echo  '</li>';
    echo  '</ul>';
    echo  '</nav>';
    echo  '<a href="logout.php" class="btn btn-primary">';
    echo  '<span class="span">Cerrar Sesión</span></a>';
    echo  ' </div>';
    echo  '<button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>';
    echo  '<ion-icon name="menu-outline" aria-hidden="true" class="open"></ion-icon>';
    echo  '<ion-icon name="close-outline" aria-hidden="true" class="close"></ion-icon>';
    echo  '</button>';
    echo  '</div>';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
    echo  '';
  
    
    echo '</header>';
    echo  '<section class="section hero" aria-label="home"></section>';
    echo '<main>';
    echo '<form method="post" action="camionero.php">';
    echo '<label for="matricula">Matrícula del camión:</label>';
    echo '<input type="text" id="matricula" name="matricula" placeholder="Escribe la matrícula">';
    echo '<button type="submit">Buscar</button>';
    echo '</form>';
    echo '</main>';
}
?>
        <?php
include("config\usersDB.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = trim($_POST["matricula"]);

    if (strpos($matricula, "TM") === false) {
        
        $sql = "SELECT r.id_trayecto, r.id_lote, t.id_almacen, t.posicion, a.calle, a.numero, a.localidad
            FROM realiza r
            JOIN tiene t ON r.id_trayecto = t.id_trayecto
            JOIN almacen a ON t.id_almacen = a.id_almacen
            WHERE r.matricula = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $matricula);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2>Resultados de la búsqueda:</h2>";
            echo "<form method='post' action='procesar_viaje.php'>";
            echo "<table>";
            echo "<tr><th>ID Trayecto</th><th>ID Lote</th><th>ID Almacen</th><th>Posición</th><th>Calle</th><th>Número</th><th>Localidad</th></tr>";

            while ($row = $result->fetch_assoc()) {
                
                echo "<tr>";
                echo "<td>" . $row["id_trayecto"] . "</td>";
                echo "<td>" . $row["id_lote"] . "</td>";
                echo "<td>" . $row["id_almacen"] . "</td>";
                echo "<td>" . $row["posicion"] . "</td>";
                echo "<td>" . $row["calle"] . "</td>";
                echo "<td>" . $row["numero"] . "</td>";
                echo "<td>" . $row["localidad"] . "</td>";
                echo "</tr>";

                
                $id_lote = $row["id_lote"];
                $id_trayecto = $row["id_trayecto"];
                $id_almacen = $row["id_almacen"];
            }

            echo "</table>";

           
            echo "<input type='hidden' name='id_lote' value='$id_lote'>";
            echo "<input type='hidden' name='id_trayecto' value='$id_trayecto'>";
            echo "<input type='hidden' name='id_almacen' value='$id_almacen'>";
            echo "<input type='text'  name='input_id_lote' placeholder='Escribe el ID del lote'>";
            echo "<input type='text'  name='input_id_trayecto' placeholder='Escribe el ID del trayecto'>";
            echo "<input type='text'  name='input_id_almacen' placeholder='Escribe el ID del almacen'>";
            echo "<button type='submit' name='viajar'>Listo</button>";
            echo "</form>";
        } else {
            echo "<p>No se encontraron resultados para la matrícula ingresada.</p>";
        }

        $stmt->close();
    } else {
        echo "<h2>Formulario para Entrega de Paquete</h2>";
        echo "<form method='post' action='procesar_entrega.php'>";
        echo "<label for='id_paquete'>ID Paquete:</label>";
        echo "<input type='text' id='id_paquete' name='id_paquete' placeholder='Escribe el ID del paquete'>";
        echo "<input type='hidden' name='matricula' value='$matricula'>"; 
        echo "<button type='submit'>Entregar Paquete</button>";
        echo "</form>";

        $queryDireccion = "SELECT 
            e.id_paquete,
            e.matricula,
            d.calle,
            d.numero
            FROM 
            entrega e
            JOIN 
            paquete p ON e.id_paquete = p.id_paquete
            JOIN 
            direccion d ON p.id_paquete = d.id_paquete
            WHERE 
            e.hora_entrega IS NULL
            AND e.matricula = ?";

        $stmtDireccion = $conn->prepare($queryDireccion);
        $stmtDireccion->bind_param("s", $matricula);
        $stmtDireccion->execute();

        $resultDireccion = $stmtDireccion->get_result();

        echo "<div>";
        echo "<h2>Paquetes para entregar</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>ID Paquete</th><th>Numero</th><th>Calle</th></tr>";
        echo "</thead>";
        echo "<tbody>";

        while ($row = mysqli_fetch_assoc($resultDireccion)) {
            echo "<tr>";
            echo "<td>" . $row['id_paquete'] . "</td>";
            echo "<td>" . $row['numero'] . "</td>";
            echo "<td>" . $row['calle'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";

        
        $stmtDireccion->close();
    }
}


$conn->close();
?>
        
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
