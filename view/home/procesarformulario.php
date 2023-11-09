<?php
if(isset($_POST['enviar'])){
    if (!empty($_POST['nombre']) && !empty($_POST['asunto']) && !empty($_POST['mensaje']) && !empty($_POST['email'])){
        $name = $_POST ['nombre'] ; 
        $emaile = $_POST ['email'] ; 
        $asunto = $_POST ['asunto'] ;  
        $msg = $_POST ['mensaje'] ;   
        $email = "megaincSRL2023@gmail.com";
        $headers = "From: $emaile\r\n"; // Dirección de correo del remitente
        $headers .= "Reply-To: $email\r\n"; // Dirección de respuesta
        $headers .= "Return-Path: $email\r\n"; // Dirección de retorno
        $mail = mail($email, $asunto, $msg, $headers) ;
        if ($mail) {
            echo "¡Mail enviado exitosamente!" ;
        }
       }
}
?>
