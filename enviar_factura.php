<?php
// Importa la biblioteca PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $grado = $_POST['grade'];
    $telefono = $_POST['phone'];

    // Crear el contenido del correo
    $mensaje = "<h1>Factura de Pedido</h1>";
    $mensaje .= "<p>Nombre: $nombre</p>";
    $mensaje .= "<p>Email: $email</p>";
    $mensaje .= "<p>Grado: $grado</p>";
    $mensaje .= "<p>Teléfono: $telefono</p>";
    // Añadir aquí los detalles del carrito y el total a pagar

    // Enviar el correo
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mauriciojalany@gmail.com'; // Tu correo Gmail
        $mail->Password = 'jalamauri'; // Tu contraseña de Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // Recipientes
        $mail->setFrom('tu_correo@gmail.com', 'Tu Nombre');
        $mail->addAddress($email, $nombre); // Correo del usuario
        $mail->addAddress('mauriciojalany@gmail.com'); // Correo de la empresa

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Factura de tu Pedido';
        $mail->Body = $mensaje;

        $mail->send();
        echo 'El pedido ha sido confirmado y la factura enviada por correo.';
    } catch (Exception $e) {
        echo "Hubo un error al enviar el correo: {$mail->ErrorInfo}";
    }
}
?>
