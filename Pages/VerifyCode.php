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

exit();
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
    <!-- Aquí puedes colocar el formulario o la lógica para verificar el código -->
    <form action="/php/process_verify_code.php" method="POST">
        <label for="codigo">Ingrese el código a verificar:</label><br>
        <label style="font-size: 10px; color: red; margin-bottom: 8px; margin-top: -10px;">Revisa tu bandeja principal o de SPAM en tu correo</label>
        <input type="text" id="codigo" name="codigo" required><br>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
