<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["id"])) {
    // Redirigir al usuario a la página de inicio de sesión si no ha iniciado sesión
    header("Location: /index.html");
    exit();
}

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conexión a la base de datos (reemplaza los valores con los de tu propia configuración)
    $servername = "10.4.27.116";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta SQL para insertar los datos en la tabla de inventario
    $stmt = $conn->prepare("INSERT INTO inventario (cliente, tipo, descripcion, codigo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $cliente, $tipo, $descripcion, $codigo);

    // Obtener los datos del formulario
    $cliente = $_POST["client_name"];
    $tipo = $_POST["TypeCinta"];
    $descripcion = $_POST["DesCin"];
    $codigo = $_POST["CCinta"];

    // Ejecutar la consulta preparada
    if ($stmt->execute() === TRUE) {
        echo "Los datos se agregaron correctamente al inventario.";
    } else {
        echo "Error al agregar los datos al inventario: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si no se recibieron datos del formulario, mostrar un mensaje de error
    echo "Error: No se recibieron datos del formulario.";
}
?>
