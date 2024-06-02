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
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los datos del formulario
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];
    $userId = $_POST["userId"]; // Id del usuario a editar

    // Actualizar los datos del usuario en la base de datos
    $sql = "UPDATE usuarios SET username='$name', email='$email', role='$role', password='$password' WHERE id=$userId";

    if ($conn->query($sql) === TRUE) {
        // Respondemos con un JSON para que el JavaScript pueda manejar la respuesta
        echo json_encode(["success" => true]);
    } else {
        // Si hay un error, también respondemos con un JSON
        echo json_encode(["success" => false, "error" => $conn->error]);
    }

    // Cerrar la conexión
    $conn->close();
}
?>
