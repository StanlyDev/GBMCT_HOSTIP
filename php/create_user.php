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

// Verificar si se ha enviado el formulario de creación de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["name"], $_POST["email"], $_POST["role"], $_POST["password"])) {
    // Obtener los datos del formulario
    $nombre = $_POST["name"];
    $correo = $_POST["email"];
    $rol = $_POST["role"];
    $password = $_POST["password"];

    // Consulta SQL para verificar si ya existe un usuario con el mismo nombre de usuario o correo electrónico
    $sql_check_duplicate = "SELECT COUNT(*) AS count FROM usuarios WHERE username = ? OR email = ?";
    $stmt_check_duplicate = $conn->prepare($sql_check_duplicate);
    
    if ($stmt_check_duplicate) {
        // Enlazar parámetros y ejecutar la consulta
        $stmt_check_duplicate->bind_param("ss", $nombre, $correo);
        $stmt_check_duplicate->execute();
        $stmt_check_duplicate->store_result();
        
        // Obtener el número de filas
        $stmt_check_duplicate->bind_result($count);
        $stmt_check_duplicate->fetch();

        if ($count > 0) {
            // Ya existe un usuario con el mismo nombre de usuario o correo electrónico
            http_response_code(400);
            echo json_encode(["error" => "Ya existe un usuario con el mismo nombre de usuario o correo electrónico"]);
        } else {
            // Consulta SQL para insertar un nuevo usuario
            $sql_insert = "INSERT INTO usuarios (username, password, role, email) VALUES (?, ?, ?, ?)";

            // Preparar la consulta de inserción
            $stmt_insert = $conn->prepare($sql_insert);
            
            if ($stmt_insert) {
                // Enlazar parámetros e insertar el usuario en la base de datos
                $stmt_insert->bind_param("ssss", $nombre, $password, $rol, $correo);
                if ($stmt_insert->execute()) {
                    // Éxito al insertar el usuario
                    $usuario = [
                        "nombre" => $nombre,
                        "correo" => $correo,
                        "rol" => $rol
                    ];
                    echo json_encode($usuario);
                } else {
                    // Error al insertar el usuario
                    http_response_code(500);
                    echo json_encode(["error" => "Error al insertar el usuario en la base de datos"]);
                }
                // Cerrar la declaración de inserción
                $stmt_insert->close();
            } else {
                // Error en la preparación de la consulta de inserción
                http_response_code(500);
                echo json_encode(["error" => "Error en la preparación de la consulta de inserción"]);
            }
        }

        // Cerrar la declaración de verificación de duplicados
        $stmt_check_duplicate->close();
    } else {
        // Error en la preparación de la consulta de verificación de duplicados
        http_response_code(500);
        echo json_encode(["error" => "Error en la preparación de la consulta de verificación de duplicados"]);
    }
}

// Cerrar la conexión
$conn->close();
?>
