<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/path/to/autoload.php'; // Ajusta la ruta según la ubicación de tu autoload.php

// Función para generar código aleatorio
function generateRandomCode($length) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
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
        $mail->Subject = 'Código Temporal para Verificación';
        $mail->Body = 'Este es su código temporal para verificación: ' . $codigoTemporal;
        $mail->AltBody = 'Su código temporal para verificación es: ' . $codigoTemporal;

        // Envía el correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Verificar si se está accediendo a través de POST (formulario enviado)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigo"])) {
    // Procesar el formulario para verificar el código
    $codigoTemporal = $_POST["codigo"];

    // Lógica para verificar el código, comparándolo con el valor almacenado en la base de datos, etc.
    // Aquí deberías implementar la lógica para verificar el código temporal recibido

    // Ejemplo básico:
    $codigoAlmacenado = $_SESSION['code_temporal'] ?? ''; // Suponiendo que se almacena en la sesión al recibir el correo

    if ($codigoTemporal === $codigoAlmacenado) {
        echo 'Código verificado correctamente.';
        // Aquí puedes implementar la lógica adicional, como eliminar la cinta del inventario, etc.
    } else {
        echo 'El código ingresado no es válido.';
    }

    exit(); // Finaliza el script después de verificar el código
}

// Si se accede a través de GET (generar código temporal y enviar correo)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Generar código temporal
    $code_temporal = generateRandomCode(4); // Genera un código de 4 dígitos

    // Guardar código en la base de datos
    $servername = "10.4.27.116";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $user_id = $_SESSION["id"];

    // Preparar y ejecutar la consulta SQL para actualizar el código temporal del usuario
    $sql = "UPDATE usuarios SET Code_Temp = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $code_temporal, $user_id);
    $stmt->execute();

    $conn->close();

    // Obtener datos del usuario logeado (suponiendo que estos datos están en la sesión)
    $correoDestino = $_SESSION['email'] ?? '';
    $nombreDestino = $_SESSION['username'] ?? '';

    // Enviar correo electrónico con el código temporal
    if (enviarCorreo($correoDestino, $nombreDestino, $code_temporal)) {
        echo 'Se ha enviado un correo electrónico con el código temporal.';
    } else {
        echo 'Error al enviar el correo electrónico.';
    }

    exit(); // Finaliza el script después de enviar el correo
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
