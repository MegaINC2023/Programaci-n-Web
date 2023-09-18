<?php
    require_once("c://xampp/htdocs/Programacion-Web/controller/homeController.php");
    session_start();
    $obj = new homeController();
    $cedula = $obj->limpiarcorreo($_POST['cedula']);
    $contraseña = $obj->limpiarcadena($_POST['contraseña']);
    $bandera = $obj->verificarusuario($cedula,$contraseña);
    if($bandera){
        $_SESSION['usuario'] = $cedula;
        header("Location:panel_control.php");
    }else{
        $error = "<li>Las claves son incorrectas</li>";
        header("Location:login.php?error=".$error);
    }
?>