<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

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
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    // Insertar el nuevo usuario en la base de datos
    $sql = "INSERT INTO usuarios (username, email, role, password) VALUES ('$name', '$email', '$role', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error al agregar el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
