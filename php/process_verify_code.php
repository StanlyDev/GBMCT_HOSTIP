<?php
session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión si no está autenticado
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el código enviado por el formulario
    $codigoIngresado = $_POST["codigo"] ?? '';

    // Obtener el código temporal del usuario desde la sesión
    $codigoTemporal = $_SESSION["Code_Temp"] ?? '';

    // Comparar el código ingresado con el código temporal
    if ($codigoIngresado === $codigoTemporal) {
        // Código válido, redirigir a DeleteInvent.php
        header("Location: /Pages/DeleteInvent.php");
        exit();
    } else {
        // Código no válido, mostrar mensaje de error o tomar otra acción
        echo "Código incorrecto. Intenta de nuevo.";
        // Puedes redirigir a otra página de error o volver al formulario de verificación
        // header("Location: /ruta/a/otra/pagina_de_error.php");
        // exit();
    }
} else {
    // Si no es una solicitud POST, redirigir a la página de verificación
    header("Location: /Pages/VerifyCode.php");
    exit();
}
?>