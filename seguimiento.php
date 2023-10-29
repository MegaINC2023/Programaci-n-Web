<?php
// Configuración de la base de datos
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_de_datos = "megainc";

// Conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar el id_paquete introducido por el usuario
    $id_paquete = $_POST['id_paquete'];

    // Consulta SQL para obtener el estado del paquete
    $consulta = "SELECT estado FROM paquete WHERE id_paquete = $id_paquete";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $estado_paquete = $fila['estado'];
        
        // Enviar el estado del paquete como respuesta JSON
        header('Content-Type: application/json');
        echo json_encode(['estado' => $estado_paquete]);
        exit; // Terminar el script aquí
    } else {
        // El paquete no se encontró en la base de datos
        header('Content-Type: application/json');
        echo json_encode(['estado' => 'No se encontró ningún paquete']);
        exit; // Terminar el script aquí
    }
}
?>
<script>function buscarEnvio() {
    // Obtener el valor del código de seguimiento
    var id_paquete = document.getElementById("tracking-code").value;

    // Realizar una solicitud AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "tu_archivo_php.php", true); // Reemplaza "tu_archivo_php.php" con la ruta al archivo PHP que maneja la búsqueda del estado

    // Configurar la función que se ejecutará cuando se complete la solicitud
    xhr.onload = function () {
        if (xhr.status == 200) {
            try {
                // Parsear la respuesta JSON
                var respuesta = JSON.parse(xhr.responseText);

                // Actualizar el estado del envío en la página
                document.getElementById("tracking-status").textContent = "Estado del Envío: " + respuesta.estado;
            } catch (error) {
                console.error("Error al parsear la respuesta JSON: " + error);
            }
        } else {
            console.error("Error en la solicitud AJAX: " + xhr.status);
        }
    };

    // Configurar el encabezado de la solicitud
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Enviar la solicitud con el id_paquete
    xhr.send("id_paquete=" + id_paquete);
}</script>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tags
  -->
  <title>NEL</title>
  <meta name="title" content="NEL">
  <meta name="description" content="Programa de Gestión Logisitca para Quick Carry">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="asset/imgs/logo.png" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="asset/css/seguimiento.css">

  <!-- 
    - custom font link
  -->
  <link rel="stylesheet" href="asset/font/font.css">



<body id="top">


  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="index.html" class="logo">
        <img src="asset/imgs/logo.png" width="160" height="50" alt="nel home">
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="iniciosesion.php" class="navbar-link">Inicio de Sesion</a>
          </li>

          <li class="navbar-item">
            <a href="seguimiento.php" class="navbar-link">Seguimiento</a>
          </li>

          <li class="navbar-item">
            <a href="contacto.php" class="navbar-link">Contacto</a>
          </li>

          <li class="navbar-item">
            <a href="#" class="navbar-link">Preguntas Frecuentes</a>
          </li>

          <li class="navbar-item">
            <a href="#section about" class="navbar-link">Sobre Nosotros</a>
          </li>

        </ul>
      </nav>

      <div class="header-action">

        <a href="tel:+12312345678901" class="contact-number">
          <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

          <span class="span">XXXXXXXXXXXXXXXS</span>
        </a>

        <a href="iniciosesion.html" class="btn btn-primary">
          <span class="span">Iniciar Sesion</span>

          <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
        </a>

      </div>

      <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="open"></ion-icon>
        <ion-icon name="close-outline" aria-hidden="true" class="close"></ion-icon>
      </button>

    </div>
  </header>







    <main>
      <section class="section hero" aria-label="home"></section>
      <form method="POST" action="">
    <div class="tracking-form">
        <h2>Ingresa tu código de seguimiento de envío</h2>
        <input type="text" name="id_paquete" id="tracking-code" placeholder="Código de seguimiento">
        <button type="button" onclick="buscarEnvio()">Buscar Envío</button>
    </div>
    <div class="tracking-result">
        <h3>Estado del Envío:</h3>
        <p id="tracking-status">Esperando consulta...</p>
        <h3>Ubicación:</h3>
        <div id="map"></div>
    </div>
</form>
      </section>
        <!-- 
        - #CONTACT
      -->

      <section class="contact" aria-label="contact" data-reveal="right">
        <div class="container">

          <ul class="contact-list">

            <li>
              <div class="contact-card">
                <div class="card-icon">
                  <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
                </div>

                <div>
                  <h3 class="h6">Número de Télefono</h3>

                  <a href="tel:+01123457890" class="card-subtitle">+598 xxxxxxxxx</a>
                </div>
              </div>
            </li>

            <li>
              <div class="contact-card">
                <div class="card-icon">
                  <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
                </div>

                <div>
                  <h3 class="h6">E-Mail </h3>

                  <a href="mailto:voltiinfo@gmail.com" class="card-subtitle">xxxxxx@gmail.com</a>
                </div>
              </div>
            </li>

            <li>
              <div class="contact-card">
                <div class="card-icon">
                  <ion-icon name="compass-outline" aria-hidden="true"></ion-icon>
                </div>

                <div>
                  <h3 class="h6">Nuestra dirección</h3>

                  <address class="card-subtitle">xxxxxxxxxxxx</address>
                </div>
              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>
  <!-- 
    - custom js link
  -->
  <script src="js/scriptsm.js"></script>
  <script src="js/script.js"></script>

   
</body>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">
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
              Sí tienes alguna duda no dudes en llamarnos al telefono que aparece debajo
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

        <img src="asset/imgs/nuestrologo.png.png" width="100"  loading="lazy">

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





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="go to top" data-go-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>






  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



</html>