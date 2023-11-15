
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
  <link type="text/css" rel="stylesheet" href="asset/css/index.css">

  <!-- 
    - custom font link
  -->
  <link rel="stylesheet" href="asset/font/font.css">
</head>


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
            <span class="en"> English </span>
            <input type="checkbox" class="check" checked>
            <span class="es"> Español </span>
          </li>

          <script>
    var check=document.querySelector(".check");
check.addEventListener('click',idioma);

function idioma (){
   let id=check.cheched;
   if(id==true) {
    location.href="index.php";
   }else{
        location.href="eng/index.php"
   }

}
</script>


          <li class="navbar-item">
            <a href="seguimiento.php" class="navbar-link">Seguimiento</a>
          </li>

          <li class="navbar-item">
            <a href="contacto.php" class="navbar-link">Contacto</a>
          </li>

          <li class="navbar-item">
            <a href="#section service" class="navbar-link">Preguntas Frecuentes</a>
          </li>

          <li class="navbar-item">
            <a href="#section about" class="navbar-link">Sobre Nosotros</a>
          </li>

        </ul>
      </nav>

      <div class="header-action">

        <a href="tel:+12312345678901" class="contact-number">
          <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

          <span class="span">+598 92 173 072</span>
        </a>

         
        </a>

      </div>
      <?php
session_start();
      if (!empty($_SESSION['usuario'])) {
    // Si el usuario ha iniciado sesión, mostrar el botón de cerrar sesión
    echo '<a href="home\logout.php" class="btn btn-primary">';
    echo '<span class="span">Cerrar Sesión</span>';
    echo '</a>';
} else {
    // Si el usuario no ha iniciado sesión, mostrar el botón de iniciar sesión
    echo '<a href="iniciosesion.php" class="btn btn-primary">';
    echo '<span class="span">Iniciar Sesion</span>';
    echo '<ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>';
    echo '</a>';
}

echo '</div>';

echo '<button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>';
echo '<ion-icon name="menu-outline" aria-hidden="true" class="open"></ion-icon>';
echo '<ion-icon name="close-outline" aria-hidden="true" class="close"></ion-icon>';
echo '</button>';

echo '</div>';
echo '</header>';
?>





  <main>
    <article>

   

      <section class="section hero" aria-label="home">
        <div class="container">

          <div class="hero-content" data-reveal="left">

            <h1 class="h1 hero-title">
              N.E.L. <span class="span">Nimble E-Commerce Logistic</span> 
            </h1>


       

            <a href="seguimiento.php" class="btn btn-primary" >
              <span class="span">Sigue tu paquete</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>

          <figure class="hero-banner" data-reveal="right">
            <img src="asset/imgs/camioncito.png" width="111" height="76" alt="Camion" class="w-100">
          </figure>

        </div>
      </section>





      <!-- 
        - #ABOUT
      -->

      <section class="section about" id="section about" aria-labelledby="about-label">
        <div class="container">

          <figure class="about-banner" data-reveal="left">
            <img src="asset/imgs/camioncito2.jpg" width="380" height="382" loading="lazy" alt="about banner"
              class="w-100 img-1">

            <img src="asset/imgs/entrega.jpg" width="347" height="349" loading="lazy" alt="about banner"
              class="w-100 img-2">
          </figure>

          <div class="about-content" data-reveal="right">

            <p class="section-subtitle has-before" id="about-label">Sobre Nosotros</p>

            <h2 class="h2 section-title">
              El servicio más rápido de Uruguay
            </h2>

            <p class="section-text">
        Entrega al instante
            </p>

            <div class="about-wrapper">

              <div class="about-card">

                <div class="title-wrapper">
                  <ion-icon name="bonfire-outline" aria-hidden="true"></ion-icon>

                  <h3 class="card-title">Rapida entrega</h3>
                </div>

                <p class="card-text">
                  Amamos entregar los paquetes en tiempo yi forma.
                </p>

              </div>

              <div class="about-card">

                <div class="title-wrapper">
                  <ion-icon name="document-text-outline" aria-hidden="true"></ion-icon>

                  <h3 class="card-title">Tus paquetes en las mejores manos</h3>
                </div>

                <p class="card-text">
                  Nos preocupa el cuidado de los envios.
                </p>

              </div>

            </div>

            <ul class="about-list">

              <li class="about-item">
                <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                <span class="span">Entrega en menos de 1 semana</span>
              </li>

              <li class="about-item">
                <ion-icon name="checkmark-circle" aria-hidden="true"></ion-icon>

                <span class="span">Disfrita de una excelente atención personalizada</span>
              </li>

            </ul>

            <a href="#" class="btn btn-primary">
              <span class="span">Lee Más</span>

              <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
            </a>

          </div>

        </div>
      </section>





 

 





      <!-- 
        - #PREGUNTAS FRECUENTES
      -->

      <section class="section service" aria-labelledby="service-label">
        <div class="container">


          <h2 class="h2 section-title" data-reveal>
            PREGUNTAS FRECUENTES
          </h2>

          <div class="wrapper">

            <ul class="service-list" data-reveal="left">

              <li class="service-item">
                <div>
                  <h3 class="h5 card-title">Vehículos de Última Generación</h3>

                  <p class="card-text">
                    Contamos con los mejores camiones.
                  </p>
                </div>

                <div class="card-icon">
                  <ion-icon name="car-outline" aria-hidden="true"></ion-icon>
                </div>
              </li>

              <li class="service-item">
                <div>
                  <h3 class="h5 card-title">¿Entregas a cualquier paete del País?</h3>

                  <p class="card-text">
                    Sí, llegamos hasta a las zonas más remotas del país para llevar su paquete.
                  </p>
                </div>

                <div class="card-icon">
                  <ion-icon name="compass-outline" aria-hidden="true"></ion-icon>
                </div>
              </li>

              <li class="service-item">
                <div>
                  <h3 class="h5 card-title">¿Cuánto tarda en llegar mi paquete?</h3>

                  <p class="card-text">
                    Máximo 72 horas
                  </p>
                </div>

                <div class="card-icon">
                  <ion-icon name="bonfire-outline" aria-hidden="true"></ion-icon>
                </div>
              </li>

            </ul>
          </div>

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
    - custom js link
  -->
  <script src="asset/js/script.js"></script>

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

</body>

</html>





