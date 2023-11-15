<?php
// Conéctate a tu base de datos (modifica esto con tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "megainc";

$conn = new mysqli($servername, $username, $password, $dbname);

$estado = "Esperando consulta..."; 
// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_paquete = $_POST["id_paquete"];
    
    // Realiza una consulta SQL para obtener el estado del paquete
    $sql = "SELECT estado FROM paquete WHERE id_paquete = $id_paquete";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $estado = $row["estado"];
  }
}
    // Cierra la conexión a la base de datos
    $conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Main meta tags -->
    <title>NEL</title>
    <meta name="title" content="NEL">
    <meta name="description" content="Logistics Management Program for Quick Carry">

    <!-- Favicon -->
    <link rel="shortcut icon" href="../asset/imgs/logo.png" type="image/svg+xml">

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="../asset/css/seguimiento.css">

    <!-- Custom font link -->
    <link rel="stylesheet" href="../asset/font/font.css">
</head>

<body id="top">

    <!-- Header -->
    <header class="header" data-header>
        <div class="container">

            <!-- Logo -->
            <a href="index.html" class="logo">
                <img src="../asset/imgs/logo.png" width="160" height="50" alt="nel home">
            </a>

            <!-- Navigation Bar -->
            <nav class="navbar" data-navbar>
                <ul class="navbar-list">

                    <!-- Login Link -->
                    <li class="navbar-item">
                        <a href="iniciosesion.php" class="navbar-link">Login</a>
                    </li>

                    <!-- Contact Link -->
                    <li class="navbar-item">
                        <a href="contacto.php" class="navbar-link">Contact</a>
                    </li>

                    <!-- FAQs Link -->
                    <li class="navbar-item">
                        <a href="#" class="navbar-link">FAQs</a>
                    </li>

                    <!-- About Us Link -->
                    <li class="navbar-item">
                        <a href="#section about" class="navbar-link">About Us</a>
                    </li>

                </ul>
            </nav>

            <!-- Header Actions -->
            <div class="header-action">

                <!-- Contact Number -->
                <a href="tel:+12312345678901" class="contact-number">
                    <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
                    <span class="span">+598 92 173 072</span>
                </a>

                <!-- Login Button -->
                <a href="iniciosesion.html" class="btn btn-primary">
                    <span class="span">Login</span>
                    <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                </a>

            </div>

            <!-- Navigation Toggle Button -->
            <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
                <ion-icon name="menu-outline" aria-hidden="true" class="open"></ion-icon>
                <ion-icon name="close-outline" aria-hidden="true" class="close"></ion-icon>
            </button>

        </div>
    </header>

    <!-- Main Content -->
    <main>
        <section class="section hero" aria-label="home"></section>
        <form method="POST" action="">
            <div class="tracking-form">
                <h2>Enter your shipment tracking code</h2>
                <input type="text" name="id_paquete" id="tracking-code" placeholder="Tracking Code">
                <button type="submit">Track Shipment</button>
            </div>
        </form>
        <div class="tracking-result">
            <h3>Shipment Status:</h3>
            <p id="tracking-status"><?php echo $estado; ?></p>
            <h3>Location:</h3>
            <div id="map"></div>
        </div>
    </main>

    <!-- Contact Section -->
    <section class="contact" aria-label="contact" data-reveal="right">
        <div class="container">

            <!-- Contact List -->
            <ul class="contact-list">

                <!-- Phone Number -->
                <li>
                    <div class="contact-card">
                        <div class="card-icon">
                            <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
                        </div>

                        <div>
                            <h3 class="h6">Phone Number</h3>
                            <a href="tel:+01123457890" class="card-subtitle">+598 xxxxxxxxx</a>
                        </div>
                    </div>
                </li>

                <!-- Email -->
                <li>
                    <div class="contact-card">
                        <div class="card-icon">
                            <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
                        </div>

                        <div>
                            <h3 class="h6">Email</h3>
                            <a href="mailto:voltiinfo@gmail.com" class="card-subtitle">xxxxxx@gmail.com</a>
                        </div>
                    </div>
                </li>

                <!-- Address -->
                <li>
                    <div class="contact-card">
                        <div class="card-icon">
                            <ion-icon name="compass-outline" aria-hidden="true"></ion-icon>
                        </div>

                        <div>
                            <h3 class="h6">Our Address</h3>
                            <address class="card-subtitle">xxxxxxxxxxxx</address>
                        </div>
                    </div>
                </li>

            </ul>

        </div>
    </section>

</body>

<!-- Footer Section -->
<footer class="footer">
    <div class="container">

        <div class="footer-top section" data-reveal>

            <div class="footer-list">

                <p class="h6 has-after">Quick Carry Description</p>

                <p class="footer-text">
                    <!-- Footer content -->
                </p>

                <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
                </a>

            </div>

            <ul class="footer-list">

                <li>
                    <p class="h6 has-after">Quick Contact</p>
                </li>

                <li>
                    <address class="footer-text">
                        <!-- Address -->
                        xxxx xxxxxxxxxxx, xxxxxxxxxxxxxxxxxx.
                    </address>
                </li>

                <li>
                    <p class="footer-text">
                        <!-- Contact Information -->
                        If you have any questions, feel free to call us at the phone number below.
                    </p>
                </li>

                <li>
                    <a href="tel:00201061245741" class="contact-link">+598 92 173 072</a>
                </li>

            </ul>

        </div>

        <div class="footer-bottom">

            <div>

                <p class="copyright">Made by Mega, INC.</a></p>
            </div>

            <!-- Logo -->
            <img src="../asset/imgs/nuestrologo.png.png" width="100" loading="lazy">

            <!-- Social Icons -->
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
    <script src="../asset/js/script.js"></script>




<!-- Ionicons Link -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
