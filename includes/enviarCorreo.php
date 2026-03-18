<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $mensaje = $_POST["mensaje"];

    $para = "donoisra@hotmail.com";
    $asunto = "Nuevo mensaje de contacto - Sortec";

    $contenido = "
    Nombre: $nombre
    Teléfono: $telefono
    Correo: $correo
    Mensaje:
    $mensaje
    ";

    $headers = "From: $correo";

    if (mail($para, $asunto, $contenido, $headers)) {
        echo "Mensaje enviado correctamente.";
    } else {
        echo "Hubo un problema al enviar el mensaje.";
    }
}
?>
