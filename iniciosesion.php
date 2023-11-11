<?php
session_start();

if (!empty($_SESSION['usuario'])) {
    header("Location: panel_control.php");
    exit();
}

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
    // Recuperar las credenciales del formulario
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL con consulta preparada para prevenir inyección SQL
    $consulta = $conexion->prepare("SELECT contraseña, tipo_de_usuario FROM login WHERE cedula = ?");
    $consulta->bind_param("s", $cedula);
    $consulta->execute();
    $consulta->store_result();

    // Verificar si se encontraron resultados
    if ($consulta->num_rows > 0) {
        $consulta->bind_result($contraseña_hasheada, $tipo_usuario);
        $consulta->fetch();

        // Verificar si la contraseña ingresada coincide con la contraseña hasheada
        if (password_verify($contraseña, $contraseña_hasheada)) {
            // Contraseña válida, puedes continuar con el manejo de sesiones
            $_SESSION['usuario'] = $cedula;
            $_SESSION['tipo_usuario'] = $tipo_usuario;

            // Redirigir según el tipo de usuario
            switch ($tipo_usuario) {
                case 'admin':
                    header('Location: view/home/pagina_admin.php');
                    exit();
                case 'chofer':
                    header('Location: view/home/camionero.php');
                    exit();
                case 'almacenista':
                    header('Location: view/home/pagina_almacenista.php');
                    exit();
                default:
                    // Redirigir a una página por defecto
                    header('Location: view/home/pagina_administracion.php');
                    exit();
            }
        } else {
            // Las credenciales son incorrectas
            header('Location: iniciosesion.php?error=Credenciales incorrectas. Por favor, intente de nuevo.');
            exit();
        }
    } else {
        // Usuario no encontrado en la base de datos
        header('Location: iniciosesion.php?error=Usuario no encontrado. Por favor, intente de nuevo.');
        exit();
    }

    // Cierra la consulta
    $consulta->close();
}

// Cierra la conexión a la base de datos al final del script
$conexion->close();
?>



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
  <link rel="stylesheet" href="asset/css/iniciosesion.css">

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

      <a href="index.php" class="logo">
        <img src="asset/imgs/logo.png" width="160" height="50" alt="nel home">
      </a>

      <?php
// Inicia sesión solo si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario ha iniciado sesión
if (!empty($_SESSION['usuario'])) {
    // Usuario ha iniciado sesión, muestra la barra de navegación con el botón de cerrar sesión
    echo '<header class="header" data-header>';
    echo '<div class="container">';

    // ... Otros elementos del encabezado ...

    echo '<nav class="navbar" data-navbar>';
    echo '<ul class="navbar-list">';

    // ... Otros elementos de la barra de navegación ...

    echo '<li class="navbar-item">';
    echo '<a href="view\home\logout.php" class="navbar-link">Cerrar Sesión</a>';
    echo '</li>';

    // Cierra los elementos del encabezado
    echo '</ul>';
    echo '</nav>';
    echo '</div>';
    echo '</header>';
} else {
    // Usuario no ha iniciado sesión, muestra una barra de navegación diferente o algo más
    echo '<div class="container">';

    echo '<nav class="navbar" data-navbar>';
    echo '<ul class="navbar-list">';

    // ... Otros elementos de la barra de navegación ...

    echo '<li class="navbar-item">';
    echo '<a href="seguimiento.php" class="navbar-link">Seguimiento</a>';
    echo '</li>';

    echo '<li class="navbar-item">';
    echo '<a href="contacto.php" class="navbar-link">Contacto</a>';
    echo '</li>';

    echo '<li class="navbar-item">';
    echo '<a href="#" class="navbar-link">Preguntas Frecuentes</a>';
    echo '</li>';

    echo '<li class="navbar-item">';
    echo '<a href="#section about" class="navbar-link">Sobre Nosotros</a>';
    echo '</li>';

    echo '</ul>';
    echo '</nav>';

    echo '<div class="header-action">';
    echo '<a href="tel:+12312345678901" class="contact-number">';
    echo '<ion-icon name="call-outline" aria-hidden="true"></ion-icon>';
    echo '<span class="span">+598 92 173 072</span>';
    echo '</a>';

    echo '<a href="iniciosesion.php" class="btn btn-primary">';
    echo '<span class="span">Iniciar Sesion</span>';
    echo '<ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>';
    echo '</a>';

    echo '</div>';

    echo '<button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>';
    echo '<ion-icon name="menu-outline" aria-hidden="true" class="open"></ion-icon>';
    echo '<ion-icon name="close-outline" aria-hidden="true" class="close"></ion-icon>';
    echo '</button>';

    echo '</div>';
}
?>
  </header>





  <main>
    <section class="section hero" aria-label="home"></section>
      
    <form  method="POST" id="login-form">
      <label for="username">Identificador</label>
      <input type="text" id="id" name="cedula" required><br><br>

      <label for="password">Contraseña:</label>
      <button type="button" onclick="mostrarContraseña('password','eyepassword')">
                    <i id="eyepassword" class="fa-solid fa-eye changePassword"></i>
                </button>
      <input type="password" id="password" name="contraseña" required><br><br>
      <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
            </div>
        
      <button type="submit">Iniciar Sesión</button>
  </form>
</section>
  </main>
     


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

                  <a href="tel:+01123457890" class="card-subtitle">+598 92 173 072</a>
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

                  <a href="mailto:voltiinfo@gmail.com" class="card-subtitle">megaincsrl2023@gmail.com</a>
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

                  <address class="card-subtitle"> Rambla 25 de Agosto de 1825 N° 160.</address>
                </div>
              </div>
            </li>

          </ul>

        </div>
      </section>

    </article>
  </main>

  



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
            Rambla 25 de Agosto de 1825 N° 160.
            </address>
          </li>

          <li>
            <p class="footer-text">
              Sí tienes alguna duda no dudes en llamarnos al telefono que aoarece debajo
            </p>
          </li>

          <li>
            <a href="tel:00201061245741" class="contact-link">+598 92 173 072</a>
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
    - custom js link
  -->
  <script src="asset/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
