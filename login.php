<?php
include('bd.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $nombre = $_POST['nombre'];
    $contrasena = $_POST['contrasena'];

   
    if ($nombre === 'nombre' && $contrasena === 'contrasena') {
       
        header('Location: index.php');
        exit();
    } else {
        
        echo "Credenciales inválidas";
    }
}
?>
<html>
<head>
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form action="login.php" method="post">
        <label for="nombre">Nombre de usuario:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="contrasena" id="contrasena" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>