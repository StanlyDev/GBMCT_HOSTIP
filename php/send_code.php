<?php
session_start();
require 'vendor/autoload.php'; // Incluir el autoload de Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Conexión a la base de datos (ejemplo básico)
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

// Obtener el usuario logueado (simulado con una variable de sesión)
$user_id = $_SESSION['id']; // Suponiendo que has establecido $_SESSION['id'] en otro lugar de tu aplicación

// Consulta para obtener el correo y nombre del usuario logueado (destinatario del correo)
$sql = "SELECT email, username FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $email = $row['email'];
    $username = $row['username'];

    // Generar un código aleatorio de 4 dígitos
    $codigo = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

    // Guardar el código temporalmente en la base de datos
    $sql_update_code = "UPDATE usuarios SET Code_Temp = ? WHERE id = ?";
    $stmt_update_code = $conn->prepare($sql_update_code);
    $stmt_update_code->bind_param("si", $codigo, $user_id);
    $stmt_update_code->execute();

    // Configuración de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'mail.gbmmedios.localhost'; // Tu host SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'no-reply@gbmmedios'; // Cambiar al correo SMTP del remitente
        $mail->Password   = '960450'; // Cambiar a la contraseña del correo SMTP del remitente
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinatario (correo y nombre del usuario logueado)
        $mail->setFrom('no-reply@gbmmedios', 'No Reply'); // Cambiar al remitente deseado
        $mail->addAddress($email, $username);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Código de validación';
        $mail->Body    = 'Hola ' . $username . ',<br>Tu código de validación es: <strong>' . $codigo . '</strong>';

        // Enviar el correo
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
