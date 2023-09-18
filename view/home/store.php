<?php
    require_once("c://xampp/htdocs/Programacion-Web/controller/homeController.php");
    $obj = new homeController();
    $cedula = $_POST['cedula'];
    $contraseña = $_POST['contraseña'];
    $confirmarContraseña = $_POST['confirmarContraseña'];
    $error = "";
    if(empty($cedula) || empty($contraseña) || empty($confirmarContraseña)){
        $error .= "<li>Completa los campos</li>";
        header("Location:signup.php?error=".$error."&&cedula=".$cedula."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
    }else if($cedula && $contraseña && $confirmarContraseña){
        if($contraseña == $confirmarContraseña){
            if($obj->guardarUsuario($cedula,$contraseña) == false){
                $error .= "<li>ya existe un ususario con esa cedula</li>";
                header("Location:signup.php?error=".$error."&&cedula=".$cedula."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
            }else{
                header("Location:signup.php");
            }
        }else{
            $error .= "<li>Las contraseñas son diferentes</li>";
            header("Location:signup.php?error=".$error."&&cedula=".$cedula."&&contraseña=".$contraseña."&&confirmarContraseña=".$confirmarContraseña);
        }
    }
?>