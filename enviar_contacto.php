<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $telefono = isset($_POST['phone']) ? $_POST['phone'] : 'No proporcionado';
    $mensaje = $_POST['message'];

    // Dirección a la que se enviará el mensaje
    $destinatario = "mauriciojalany@gmail.com";
    
    // Asunto del correo
    $asunto = "Nuevo mensaje de contacto de $nombre";

    // Cuerpo del mensaje para el administrador
    $cuerpo_mensaje = "Nombre: $nombre\n";
    $cuerpo_mensaje .= "Correo: $correo\n";
    $cuerpo_mensaje .= "Teléfono: $telefono\n";
    $cuerpo_mensaje .= "Mensaje: \n$mensaje\n";

    // Enviar el mensaje al correo del administrador
    $headers = "From: $correo";
    mail($destinatario, $asunto, $cuerpo_mensaje, $headers);

    // Enviar correo de confirmación al usuario
    $asunto_confirmacion = "Confirmación de recepción de mensaje";
    $mensaje_confirmacion = "Hola $nombre,\n\n";
    $mensaje_confirmacion .= "Gracias por contactarnos. Hemos recibido tu mensaje y pronto estaremos respondiendo.\n";
    $mensaje_confirmacion .= "Este es el resumen de tu mensaje:\n\n";
    $mensaje_confirmacion .= "Mensaje: $mensaje\n\n";
    $mensaje_confirmacion .= "Saludos,\nEl equipo de atención al cliente.";

    // Enviar el correo de confirmación al remitente
    mail($correo, $asunto_confirmacion, $mensaje_confirmacion, "From: mauriciojalany@gmail.com");

    // Redirigir a una página de confirmación o mostrar un mensaje de éxito
    echo "Mensaje enviado. Pronto estaremos en contacto.";
} else {
    echo "Hubo un error al procesar el formulario.";
}
?>
