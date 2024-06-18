<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    http_response_code(403); // No autorizado
    exit("Usuario no autenticado");
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

    // Respuesta exitosa
    http_response_code(200);
    exit();
} catch(PDOException $e) {
    http_response_code(500); // Error interno del servidor
    exit("Error al actualizar el código en la base de datos: " . $e->getMessage());
}
?>