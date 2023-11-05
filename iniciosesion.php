<?php

if (!empty($_SESSION['usuario'])) {
    header("Location: panel_control.php");
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

    // Consulta SQL para obtener la contraseña hasheada
    $consulta = "SELECT contraseña FROM login WHERE cedula = '$cedula'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $contraseña_hasheada = $fila['contraseña'];

        // Verificar si la contraseña ingresada coincide con la contraseña hasheada
        if (password_verify($contraseña, $contraseña_hasheada)) {
            // Contraseña válida, puedes continuar con la redirección según el tipo de usuario
            $consulta_tipo_usuario = "SELECT tipo_de_usuario FROM login WHERE cedula = '$cedula'";
            $resultado_tipo_usuario = $conexion->query($consulta_tipo_usuario);

            if ($resultado_tipo_usuario->num_rows > 0) {
                $fila_tipo_usuario = $resultado_tipo_usuario->fetch_assoc();
                $tipo_usuario = $fila_tipo_usuario['tipo_de_usuario'];

                if ($tipo_usuario == 'admin') {
                    header('Location: view/home/pagina_admin.php');
                } elseif ($tipo_usuario == 'chofer') {
                    header('Location: view/home/camionero.php');
                } elseif ($tipo_usuario == 'almacenista') {
                    header('Location: view/home/pagina_almacenista.php');
                } else {
                    // El usuario no es un administrador, puedes redirigirlo a otra página si lo deseas
                    header('Location: view/home/pagina_administracion.php');
                }
            }
        } else {
            // Las credenciales son incorrectas, redirigir de nuevo al formulario de inicio de sesión con un mensaje de error
            header('Location: iniciosesion.php?error=Credenciales incorrectas. Por favor, intente de nuevo.');
        }
    } else {
        // Usuario no encontrado en la base de datos
        header('Location: iniciosesion.php?error=Usuario no encontrado. Por favor, intente de nuevo.');
    }
}
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

        <a href="iniciosesion.php" class="btn btn-primary">
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
