<?php
session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión si no ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

// Verificar si se ha recibido un ID válido para la cinta a eliminar
if (!isset($_POST["id"]) || empty($_POST["id"])) {
    http_response_code(400); // Código de error 400 para solicitud incorrecta
    exit("Error: ID de cinta no proporcionado.");
}

// Recuperar el ID de la cinta a eliminar
$cinta_id = $_POST["id"];

// Conectar a la base de datos
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "nombre_de_tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    http_response_code(500); // Código de error 500 para error interno del servidor
    exit("Error de conexión: " . $conn->connect_error);
}

// Preparar la declaración SQL para eliminar la cinta
$sql = "DELETE FROM tabla_de_cintas WHERE id = $cinta_id";

// Ejecutar la declaración SQL
if ($conn->query($sql) === TRUE) {
    // La cinta se eliminó correctamente
    http_response_code(200); // Código de éxito 200
    echo "Cinta eliminada exitosamente.";
} else {
    // Error al eliminar la cinta
    http_response_code(500); // Código de error 500 para error interno del servidor
    echo "Error al eliminar la cinta: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
