<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    // Manejo de error o redireccionamiento si el usuario no está autenticado
    die("Usuario no autenticado");
}

// Conexión a la base de datos (debes tener tus propios datos de conexión)
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

    $codigoAleatorio = generarCodigoAleatorio();

    // Obtener el ID del usuario logeado desde la sesión
    $usuario_id = $_SESSION["id"];

    // Preparar la consulta SQL para actualizar el código temporal
    $stmt = $conn->prepare("UPDATE usuarios SET Code_Temp = :codigo WHERE id = :id");
    $stmt->bindParam(':codigo', $codigoAleatorio);
    $stmt->bindParam(':id', $usuario_id);
    $stmt->execute();

    echo "Código generado y guardado exitosamente: $codigoAleatorio";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
