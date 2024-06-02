<?php
session_start();

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos
    $servername = "10.4.27.113";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    // Conectar a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        error_log("Error de conexión: " . $conn->connect_error);
        http_response_code(500);
        echo json_encode(["error" => "Error de conexión a la base de datos"]);
        exit();
    }

    // Obtener los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO usuarios (username, email, role, password) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Error al preparar la consulta: " . $conn->error);
        http_response_code(500);
        echo json_encode(["error" => "Error al preparar la consulta"]);
        exit();
    }

    $stmt->bind_param("ssss", $name, $email, $role, $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo json_encode(["message" => "Usuario agregado exitosamente."]);
    } else {
        error_log("Error al ejecutar la consulta: " . $stmt->error);
        http_response_code(500);
        echo json_encode(["error" => "Error al agregar el usuario"]);
    }

    // Cerrar la consulta y la conexión
    $stmt->close();
    $conn->close();
} else {
    http_response_code(400);
    echo json_encode(["error" => "Solicitud inválida"]);
}
?>
