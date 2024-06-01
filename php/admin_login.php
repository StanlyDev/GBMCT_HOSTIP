<?php
session_start();

$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"]; // Cambiado de username a email
    $password = $_POST["password"];

    // Escapar caracteres especiales para evitar inyección SQL
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Consulta para buscar al administrador por email y permitir que tanto los administradores como los usuarios root inicien sesión
    $sql = "SELECT id, username, role FROM usuarios WHERE email='$email' AND password='$password' AND (role='admin' OR role='root')";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Admin encontrado, permitir creación de usuario
        $_SESSION["email"] = $email; // Cambiado de username a email
        header("Location: /Pages/create_user.php");
        exit();
    } else {
        // Credenciales incorrectas
        $_SESSION["adminErrorMsg"] = "Usuario o contraseña incorrectos";
        header("Location: /index.html");
        exit();
    }
}

// Cerrar conexión MySQL
$conn->close();
?>
