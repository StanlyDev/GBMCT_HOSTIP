<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
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

        // Enviar correo electrónico con PHPMailer
        require '/vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta si usas Composer

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        // Configuración de PHPMailer
        $mail = new PHPMailer(true);

        // Configuración del servidor SMTP y envío de correo
        try {
            $mail->isSMTP();
            $mail->Host = 'localhost'; // Usa localhost porque el servidor SMTP está en la misma máquina
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply'; // Cambia esto a tu dirección de correo electrónico
            $mail->Password = '960450'; // Cambia esto a tu contraseña de correo electrónico
            $mail->SMTPSecure = 'tls'; // 'ssl' o 'tls' según lo requiera tu servidor
            $mail->Port = 587; // Cambia esto al puerto que tu servidor utiliza (25, 465, 587, etc.)

            // Configuración del correo electrónico
            $mail->setFrom('no-reply@gbmmedios', 'GBM Medios');
            $mail->addAddress($correoUsuario);
            $mail->Subject = 'Código de Verificación';
            $mail->Body = 'Tu código de verificación es: ' . $codigoAleatorio;

            // Enviar correo electrónico
            $mail->send();
            echo 'Correo enviado correctamente';
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        echo "No se encontró correo electrónico para el usuario con ID: $usuario_id";
    }

    // Cerrar conexión
    $conn = null;
} catch(PDOException $e) {
    echo "Error al actualizar el código en la base de datos: " . $e->getMessage();
    die();
}
?>
