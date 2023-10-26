<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    $destinatario = "megaincsrl2023@gmail.com"; 
    $asunto = "Mensaje de contacto de $nombre";
    $cuerpo = "Nombre: $nombre\n";
    $cuerpo .= "Email: $email\n";
    $cuerpo .= "Mensaje:\n$mensaje";

    // Envía el correo
    $enviado = mail($destinatario, $asunto, $cuerpo);

    if ($enviado) {
        echo "Mensaje enviado correctamente. ¡Gracias por contactarnos!";
    } else {
        echo "Hubo un problema al enviar el mensaje. Por favor, inténtalo de nuevo.";
    }
}
?>
