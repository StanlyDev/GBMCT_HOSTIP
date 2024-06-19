<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

// Generar código temporal
$code_temporal = generateRandomCode(4); // Generar código de 4 dígitos

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

// Preparar y ejecutar la consulta SQL
$sql = "UPDATE usuarios SET Code_Temp = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $code_temporal, $user_id);
$stmt->execute();

$conn->close();

// Redirigir al usuario a la página VerifyCode.php con el código temporal en la URL
header("Location: /Pages/VerifyCode.php?code=$code_temporal");
exit();

// Función para generar código aleatorio
function generateRandomCode($length) {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>
