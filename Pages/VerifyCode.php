<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/vendor/autoload.php'; // Ajusta la ruta según la ubicación de tu autoload.php

session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

// Función para enviar el correo
function enviarCorreo($correoDestino, $nombreDestino, $codigoTemporal) {
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
        $mail->addAddress($correoDestino, $nombreDestino);

        // Configura el contenido del correo
        $mail->isHTML(true); // Habilita el contenido HTML
        $mail->Subject = 'Asunto del Correo';
        $mail->Body = 'Este es el cuerpo del correo en formato HTML con el código temporal: ' . $codigoTemporal;
        $mail->AltBody = 'Este es el cuerpo del correo en texto plano para clientes que no soportan HTML. Código temporal: ' . $codigoTemporal;

        // Envía el correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Procesar el formulario para verificar el código
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"])) {
    // Aquí debes implementar la lógica para verificar el código y enviar el correo
    $codigoTemporal = $_POST["codigo"];

    // Obtener datos del usuario logeado (suponiendo que estos datos están en la sesión)
    $correoDestino = $_SESSION['email'] ?? '';
    $nombreDestino = $_SESSION['username'] ?? '';

    // Ejemplo de llamada a la función enviarCorreo
    if (enviarCorreo($correoDestino, $nombreDestino, $codigoTemporal)) {
        echo 'Correo enviado correctamente.';
    } else {
        echo 'Error al enviar el correo.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <link rel="stylesheet" href="/CSS/validate_code.css">
</head>
<body>
    <h1>Verificar Código</h1>
    <!-- Formulario para ingresar el código -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="codigo">Ingrese el código a verificar:</label><br>
        <input type="text" id="codigo" name="codigo" required><br>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
