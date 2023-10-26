<?php
    
    if(!empty($_SESSION['usuario'])){
        header("Location:panel_control.php");
    }
?>
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
    // Recuperar las credenciales del formulario
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['contraseña'];

    // Consulta SQL para verificar las credenciales
    $consulta = "SELECT * FROM login WHERE cedula = '$cedula' AND contraseña = '$contraseña'";
    $resultado = $conexion->query($consulta);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $tipo_usuario = $fila['tipo_de_usuario'];

       if ($tipo_usuario == 'admin') {
            header('Location: pagina_admin.php');
        } elseif ($tipo_usuario == 'chofer') {
            header('Location: pagina_chofer.php');
        } elseif ($tipo_usuario == 'almacenista') {
            header('Location: pagina_almacenista.php');
        } else {
            // El usuario no es un administrador, puedes redirigirlo a otra página si lo deseas
            header('Location: otra_pagina.php');
        }
    } else {
        // Las credenciales son incorrectas, redirigir de nuevo al formulario de inicio de sesión con un mensaje de error
        header('Location: inicio_sesion.php?error=Credenciales incorrectas. Por favor, intente de nuevo.');
    }
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>


<div class="fondo-login">
    <div class="icon">
        <a href="/Programacion-Web/index.php">
            <i class="fa-solid fa-shield-dog dog-icon"></i>
        </a>
    </div>
    <div class="titulo">
        Inicia sesion en NEL
    </div>
    <form  method="POST" class="col-3 login" autocomplete="off">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Cedula</label>
            <input name="cedula" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Contraseña</label>
            <div class="box-eye">
                <button type="button" onclick="mostrarContraseña('password','eyepassword')">
                    <i id="eyepassword" class="fa-solid fa-eye changePassword"></i>
                </button>
            </div>
            <input type="password" name="contraseña" class="form-control" id="password">
        </div>
        <?php if(!empty($_GET['error'])):?>
            <div id="alertError" style="margin: auto;" class="alert alert-danger mb-2" role="alert">
                <?= !empty($_GET['error']) ? $_GET['error'] : ""?>
            </div>
        <?php endif;?>
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Iniciar Sesion</button>
        </div>
    </form>
</div>

<?php
    require_once("c://xampp/htdocs/Programacion-Web/view/head/footer.php");
?>