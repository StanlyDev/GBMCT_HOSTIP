<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

// Datos de conexión a la base de datos
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos enviados desde el cliente
$data = json_decode(file_get_contents("php://input"), true);

// Iterar sobre los datos recibidos
foreach ($data['data'] as $row) {
    $nombreCliente = $conn->real_escape_string($row[0]);
    $tipoCinta = $conn->real_escape_string($row[1]);
    $descripcion = $conn->real_escape_string($row[2]);
    $codigoCinta = $conn->real_escape_string($row[3]);
    $tickectSR = $conn->real_escape_string($row[4]);
    $fdmEmail = $conn->real_escape_string($row[5]);
    $hrAdd = $conn->real_escape_string($row[6]);
    $dateAdd = $conn->real_escape_string($row[7]);
    $operatorName = $conn->real_escape_string($row[8]);
    $co = $conn->real_escape_string($row[9]);

    // Preparar la consulta SQL
    $sql = "INSERT INTO TableInventory (NombreCliente, TipoCinta, Descripcion, CodigoCinta, TickectSR, FDMEmail, HrAdd, DateAdd, OperatorName, CO)
    VALUES ('$nombreCliente', '$tipoCinta', '$descripcion', '$codigoCinta', '$tickectSR', '$fdmEmail', '$hrAdd', '$dateAdd', '$operatorName', '$co')";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        $response['success'][] = "Los datos se agregaron correctamente a la base de datos.";
    } else {
        $response['error'][] = "Error al insertar datos: " . $conn->error;
    }
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión
$conn->close();
?>
