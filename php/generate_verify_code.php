<?php
session_start();

// Habilitar el reporte de errores, pero no mostrarlos en la salida
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('html_errors', 0);

// Incluir PHPMailer a través de Composer
require '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Función para enviar respuesta JSON
function enviarRespuestaJSON($respuesta) {
    header('Content-Type: application/json');
    echo json_encode($respuesta);
    exit();
}

// Capturar errores de PHP y enviarlos como JSON
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    enviarRespuestaJSON(['error' => "Error: $errstr en $errfile en la línea $errline"]);
});

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    enviarRespuestaJSON(['error' => 'No se ha iniciado sesión']);
}

// Obtener el ID de usuario de la sesión
$usuario_id = $_SESSION["id"];

// Generar código aleatorio
function generarCodigoAleatorio() {
    $longitud = 4;
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $codigo = '';

    for ($i = 0; $i < $longitud; $i++) {
        $codigo .= $caracteres[random_int(0, strlen($caracteres) - 1)];
    }

    return $codigo;
}

// Obtener el código generado
$codigoAleatorio = generarCodigoAleatorio();

// Guardar el código en la sesión del usuario
$_SESSION["Code_Temp"] = $codigoAleatorio;

// Guardar el código en la base de datos
try {
    // Configuración de conexión a la base de datos
    $servername = "10.4.27.116";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar consulta para obtener el correo del usuario
    $stmt = $conn->prepare("SELECT email FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();

    // Obtener el resultado (debería ser único ya que se filtra por ID de usuario)
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $correoUsuario = $resultado['email'];

        // Preparar la consulta SQL para actualizar el código temporal en la base de datos
        $stmt = $conn->prepare("UPDATE usuarios SET Code_Temp = :codigo WHERE id = :id");
        $stmt->bindParam(':codigo', $codigoAleatorio);
        $stmt->bindParam(':id', $usuario_id);
        $stmt->execute();

        // Configuración de PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'localhost'; // Usa localhost porque el servidor SMTP está en la misma máquina
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply'; // Cambia esto a tu dirección de correo electrónico
            $mail->Password = '960450'; // Cambia esto a tu contraseña de correo electrónico
            $mail->SMTPSecure = 'tls'; // 'ssl' o 'tls' según lo requiera tu servidor
            $mail->Port = 587; // Cambia esto al puerto que tu servidor utiliza (25, 465, 587, etc.)

            // Configuración del correo electrónico
            $mail->setFrom('no-reply@gbmmedios.com', 'GBM Medios');
            $mail->addAddress($correoUsuario);
            $mail->Subject = 'Código de Verificación';
            $mail->Body = 'Tu código de verificación es: ' . $codigoAleatorio;

            // Enviar correo electrónico
            $mail->send();
            enviarRespuestaJSON(['message' => 'Correo enviado correctamente']);
        } catch (Exception $e) {
            enviarRespuestaJSON(['error' => "Error al enviar el correo: {$mail->ErrorInfo}"]);
        }
    } else {
        enviarRespuestaJSON(['error' => "No se encontró correo electrónico para el usuario con ID: $usuario_id"]);
    }

    // Cerrar conexión
    $conn = null;
} catch(PDOException $e) {
    enviarRespuestaJSON(['error' => "Error al actualizar el código en la base de datos: " . $e->getMessage()]);
}
?>
