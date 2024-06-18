<?php
session_start();
require 'vendor/autoload.php'; // Incluir el autoload de Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Conexión a la base de datos
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el usuario logueado
$user_id = $_SESSION['id'];

// Obtener el correo del usuario
$sql = "SELECT email FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];

    // Generar un código aleatorio de 4 dígitos
    $codigo = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

    // Guardar el código en la base de datos
    $sql = "UPDATE usuarios SET Code_Temp = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $codigo, $user_id);
    $stmt->execute();

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'mail.gbmmei.com'; // Cambia esto por el host de tu servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tu_correo@example.com'; // Cambia esto por tu correo
        $mail->Password   = 'tu_contraseña'; // Cambia esto por tu contraseña
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinatarios
        $mail->setFrom('tu_correo@example.com', 'Nombre del Remitente');
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Código de validación';
        $mail->Body    = 'Tu código de validación es: ' . $codigo;

        $mail->send();
        echo 'El mensaje ha sido enviado.';
    } catch (Exception $e) {
        echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo 'No se encontró el correo del usuario.';
}

$conn->close();
?>
