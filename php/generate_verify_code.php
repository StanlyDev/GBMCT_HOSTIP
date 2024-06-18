<?php
session_start();

// Generar código aleatorio
function generarCodigoAleatorio($longitud = 4) {
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

    // Obtener el ID del usuario logeado desde la sesión
    $usuario_id = $_SESSION["id"];

    // Preparar la consulta SQL para actualizar el código temporal en la base de datos
    $stmt = $conn->prepare("UPDATE usuarios SET Code_Temp = :codigo WHERE id = :id");
    $stmt->bindParam(':codigo', $codigoAleatorio);
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();

    // Cerrar conexión
    $conn = null;
} catch(PDOException $e) {
    echo "Error al actualizar el código en la base de datos: " . $e->getMessage();
    die();
}

// Función para enviar correo electrónico
function enviarCorreo($destinatario, $codigo) {
    $asunto = "Código de verificación";
    $mensaje = "Su código de verificación es: $codigo";

    // Establecer cabeceras del correo
    $cabeceras = "From: gbmmedios.localhost\r\n";
    $cabeceras .= "Reply-To: bventura@gbm.net\r\n";
    $cabeceras .= "Content-type: text/html\r\n";

    // Enviar correo
    if (mail($destinatario, $asunto, $mensaje, $cabeceras)) {
        return true;
    } else {
        return false;
    }
}

// Obtener el correo electrónico del usuario desde la base de datos
try {
    // Conexión PDO ya establecida en el bloque anterior
    $stmt = $conn->prepare("SELECT email FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado && isset($resultado['email'])) {
        $correoDestino = $resultado['email'];

        // Llamar a la función para enviar el correo
        if (enviarCorreo($correoDestino, $codigoAleatorio)) {
            echo "Código generado y enviado por correo electrónico: $codigoAleatorio";
        } else {
            echo "Error al enviar el correo electrónico.";
        }
    } else {
        echo "No se encontró un correo electrónico para este usuario.";
    }
} catch(PDOException $e) {
    echo "Error al obtener el correo electrónico: " . $e->getMessage();
    die();
}

// Redirigir a la página de verificación de código
header("Location: /Pages/VerifyCode.php");
exit();
?>