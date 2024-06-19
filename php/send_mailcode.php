<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'ruta/a/PHPMailerAutoload.php';

$mail = new PHPMailer(true); // Instancia de PHPMailer con manejo de excepciones

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.tudominio.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tu_correo@tudominio.com';
    $mail->Password = 'tu_contraseña';
    $mail->SMTPSecure = 'tls'; // Recuerda usar tls o ssl según la configuración de tu servidor
    $mail->Port = 587; // Puerto SMTP

    // Configuración del correo electrónico
    $mail->setFrom('tu_correo@tudominio.com', 'Tu Nombre');
    $mail->addAddress('correo_destino@ejemplo.com'); // Agrega destinatarios
    $mail->Subject = 'Asunto del Correo';
    $mail->Body = 'Este es el cuerpo del mensaje';

    // Envío del correo
    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo 'Error al enviar el correo: ' . $mail->ErrorInfo;
}
?>
