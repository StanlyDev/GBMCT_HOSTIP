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

// Inicializar mensaje de error vacío
$errorMsg = "";

// Verificar si se enviaron datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Escapar caracteres especiales para evitar inyección SQL
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Consulta para buscar el usuario en la tabla 'usuarios'
    $sql = "SELECT id, username, role FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Usuario encontrado, iniciar sesión
        $row = $result->fetch_assoc();
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];

        // Enviar respuesta de éxito al cliente
        echo json_encode(array("success" => true));
        exit();
    } else {
        // Usuario no encontrado, establecer mensaje de error
        $errorMsg = "Usuario o contraseña incorrectos";
        echo json_encode(array("success" => false, "errorMsg" => $errorMsg));
        exit();
    }
}

// Cerrar conexión MySQL
$conn->close();
?>
