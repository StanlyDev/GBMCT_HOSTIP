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
    $nombre = $_POST["name"];
    $correo = $_POST["email"];
    $rol = $_POST["role"];
    $contraseña = $_POST["password"];

    // Escapar caracteres especiales para evitar inyección SQL
    $nombre = $conn->real_escape_string($nombre);
    $correo = $conn->real_escape_string($correo);
    $rol = $conn->real_escape_string($rol);
    $contraseña = $conn->real_escape_string($contraseña);

    // Insertar nuevo usuario en la tabla 'usuarios'
    $sql = "INSERT INTO usuarios (nombre, correo, rol, contraseña) VALUES ('$nombre', '$correo', '$rol', '$contraseña')";
    
    if ($conn->query($sql) === TRUE) {
        // Obtener el ID del usuario recién insertado
        $usuario_id = $conn->insert_id;

        // Consulta para obtener los datos del usuario recién insertado
        $consulta_usuario = $conn->query("SELECT * FROM usuarios WHERE id = $usuario_id");

        // Verificar si se encontró el usuario
        if ($consulta_usuario->num_rows > 0) {
            // Obtener los datos del usuario
            $usuario = $consulta_usuario->fetch_assoc();

            // Devolver los datos del usuario como respuesta en formato JSON
            echo json_encode($usuario);
        } else {
            echo "No se pudo encontrar el usuario recién creado";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión MySQL
$conn->close();
?>
