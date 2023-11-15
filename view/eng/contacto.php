<?php
    require("../home/procesarformulario.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tags
  -->
  <title>NEL</title>
  <meta name="title" content="NEL">
  <meta name="description" content="Logistics Management Program for Quick Carry">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="../asset/imgs/logo.png" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../asset/css/contacto.css">

  <!-- 
    - custom font link
  -->
  <link rel="stylesheet" href="../asset/font/font.css">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <a href="index.php" class="logo">
        <img src="../asset/imgs/logo.png" width="160" height="50" alt="nel home">
      </a>

      <nav class="navbar" data-navbar>
        <ul class="navbar-list">

          <li class="navbar-item">
            <span class="en"> English </span>
            <input type="checkbox" class="check" checked>
            <span class="es"> Español </span>
          </li>

          <li class="navbar-item">
            <a href="seguimiento.php" class="navbar-link">Tracking</a>
          </li>

          <li class="navbar-item">
            <a href="contacto.php" class="navbar-link">Contact</a>
          </li>


        </ul>
      </nav>

      <div class="header-action">

        <a href="tel:+12312345678901" class="contact-number">
          <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

          <span class="span">+598 92 173 072</span>
        </a>

        <a href="iniciosesion.php" class="btn btn-primary">
          <span class="span">Login</span>

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
    <article>

      <section class="section hero" aria-label="home"></section>
      <div class="container-form">
        <div class="info-form">
          <h2>Contact Us</h2>
          <p>Do you want to get in touch with us? You can do so through the phone number and email provided, or you can leave us a message here.</p>
          <a href="#"><i class="fa fa-phone"></i> +598 92 173 072</a>
          <a href="#"><i class="fa fa-envelope"></i> megaincsrl2023@gmail.com</a>
          <a href="#"><i class="fa fa-map-marked"></i> Montevideo, Uruguay</a>
        </div>
        <form method="post">
          <input type="text" name="name" placeholder="Your Name" class="field" required="">
          <input type="email" name="email" placeholder="Your Email" class="field" required="">
          <input type="text" name="subject" placeholder="Subject" class="field" required="">
          <textarea name="message" placeholder="Your Message..."></textarea>
          <input type="submit" name="send" value="Send Message" class="btn-send">
        </form>
        <?php
        include("../view/home/procesarformulario.php");
        ?>
      </div>
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
                  <h3 class="h6">Phone Number</h3>

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
                  <h3 class="h6">Our Address</h3>

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

          <p class="h6 has-after">Quick Carry Description</p>

          <p class="footer-text">

          </p>

          <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
          </a>

        </div>

        <ul class="footer-list">

          <ul class="footer-list">

            <li>
              <p class="h6 has-after">Quick Contact</p>
            </li>

            <li>
              <address class="footer-text">
                xxxx xxxxxxxxxxx, xxxxxxxxxxxxxxxxxx.
              </address>
            </li>

            <li>
              <p class="footer-text">
                If you have any questions, feel free to call us at the phone number below.
              </p>
            </li>

            <li>
              <a href="tel:+00201061245741" class="contact-link">+598 92 173 072</a>
            </li>

          </ul>

        </div>

        <div class="footer-bottom">

          <div>

            <p class="copyright">Made by Mega, INC.</a></p>
          </div>

          <img src="asset/imgs/nuestrologo.png.png" width="100" loading="lazy">

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
    </div>
  </footer>
  <script>
    var check=document.querySelector(".check");
check.addEventListener('click',idioma);

function idioma (){
   let id=check.cheched;
   if(id==true) {
    location.href="contacto.php";
   }else{
        location.href="../contacto.php"
   }

}
</script>

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

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
