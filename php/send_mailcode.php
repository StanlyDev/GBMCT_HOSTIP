<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/vendor/autoload.php'; // Incluye el autoload de Composer

// Inicia sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['id'])) {
    die('Usuario no autenticado');
}

// Obtén los datos del usuario de la sesión
$emailDestino = $_SESSION['email'] ?? '';
$nombreDestino = $_SESSION['username'] ?? '';

if (empty($emailDestino)) {
    die('No se encontró una dirección de correo para el usuario');
}

try {
    // Inicializa PHPMailer
    $mail = new PHPMailer(true);

    // Configura el servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'localhost'; // Cambia por tu servidor SMTP
    $mail->SMTPAuth = false; // No requiere autenticación si es envío directo desde SMTP
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Habilita la encriptación TLS
    $mail->Port = 587; // Puerto TCP para conectarse

    // Configura destinatario
    $mail->addAddress($emailDestino, $nombreDestino); // Usa los datos del usuario autenticado como destinatario

    // Configura el contenido del correo
    $mail->isHTML(true); // Habilita el contenido HTML
    $mail->Subject = 'Asunto del Correo';
    $mail->Body = 'Este es el cuerpo del correo en formato HTML.';
    $mail->AltBody = 'Este es el cuerpo del correo en texto plano para clientes que no soportan HTML.';

    // Envía el correo
    $mail->send();
    echo 'El correo se envió correctamente';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>
