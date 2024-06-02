<?php
session_start();

// Obtener el rol del usuario desde la sesión
$usuario_rol = $_SESSION["role"] ?? '';

// Datos de conexión a la base de datos
$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener usuarios
$sql = "SELECT id, username, email, role FROM usuarios";
$result = $conn->query($sql);

// Crear un array para almacenar los usuarios
$usuarios = [];

// Obtener resultados de la consulta y agregarlos al array de usuarios
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Devolver usuarios en formato JSON
header('Content-Type: application/json');
echo json_encode($usuarios);

// Cerrar la conexión
$conn->close();
?>
