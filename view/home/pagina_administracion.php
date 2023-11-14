<!DOCTYPE html>
<html lang="es">
<head>
 
    
    <link rel="stylesheet" href="../../asset/css/seguimiento.css">

</head>
<body>
    <header>
    <header class="header" data-header>
    <div class="container">

      <a href="index.php" class="logo">
        <img src="../../asset/imgs/logo.png" width="160" height="50" alt="nel home">
      </a>

      <nav class="navbar" data-navbar>
      <ul class="navbar-list">
      <li class="navbar-item">
            <a >Página de Personal Administrativo</a>
          </li>
          </ul>
      </nav>
      <a href="logout.php" class="btn btn-primary">
    <span class="span">Cerrar Sesión</span></a>

      </div>

      <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="open"></ion-icon>
        <ion-icon name="close-outline" aria-hidden="true" class="close"></ion-icon>
      </button>

    </div>




    </header>

<main>
<section class="section hero" aria-label="home"></section>
    <form method="POST">
        <label for="id_lote">ID del lote:</label>
        <input type="text" id="id_lote" name="id_lote" placeholder="Escribe el ID del lote">
        <button type="submit">Buscar</button>
    </form>

    <?php
     include("config\usersDB.php");
     
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $idLote = $_POST["id_lote"];

       

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