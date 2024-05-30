<?php
session_start();

$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv_00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Escapar caracteres especiales para evitar inyección SQL
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Consulta para buscar el administrador
    $sql = "SELECT id, username, role FROM usuarios WHERE username='$username' AND password='$password' AND (role='admin' OR role='root')";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Admin encontrado, permitir creación de usuario
        $_SESSION["admin"] = $username;
        header("Location: /Pages/create_user.html");
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
