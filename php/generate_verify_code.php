<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

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

// Obtener el email del usuario desde la sesión
$emailUsuario = $_SESSION["email"] ?? '';

// Enviar correo electrónico con el código de verificación
$to = $emailUsuario;
$subject = 'Código de verificación';
$message = "Tu código de verificación es: $codigoAleatorio";
$headers = 'From: gbmmedios.localhost' . "\r\n" .
           'Reply-To: bventura@gbm.net' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo "Correo electrónico enviado correctamente a $to";
} else {
    echo "Error al enviar el correo electrónico.";
}

// Redirigir a la página de verificación de código
header("Location: /Pages/VerifyCode.php");
exit();
?>
