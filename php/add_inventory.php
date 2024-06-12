<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    error_log("Error de conexión: " . $conn->connect_error);
    echo "Error de conexión: " . $conn->connect_error;
    exit();
}

// Leer datos de la solicitud
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Verificar errores en la decodificación del JSON
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log("Error en la decodificación del JSON: " . json_last_error_msg());
    echo "Error en la decodificación del JSON: " . json_last_error_msg();
    exit();
}

// Verificar que se hayan recibido datos
if (empty($data)) {
    error_log("No se recibieron datos.");
    echo "No se recibieron datos.";
    exit();
}

// Preparar y ejecutar la consulta para cada cinta
foreach ($data as $cinta) {
    $client_name = $conn->real_escape_string($cinta['client_name']);
    $co = $conn->real_escape_string($cinta['co']);
    $sr = $conn->real_escape_string($cinta['sr']);
    $enc = $conn->real_escape_string($cinta['enc']);
    $hrEsti = $conn->real_escape_string($cinta['hrEsti']);
    $FechaIO = $conn->real_escape_string($cinta['FechaIO']);
    $ingr = $conn->real_escape_string($cinta['ingr']);
    $TypeCinta = $conn->real_escape_string($cinta['TypeCinta']);
    $DesCin = $conn->real_escape_string($cinta['DesCin']);
    $CCinta = $conn->real_escape_string($cinta['CCinta']);

    $sql = "INSERT INTO TableInventory (NombreCliente, TipoCinta, Descripcion, CodigoCinta, TicketSR, FMDEmail, HrAdd, DateAdd, OperatorName, CO)
            VALUES ('$client_name', '$TypeCinta', '$DesCin', '$CCinta', '$sr', '$enc', '$hrEsti', '$FechaIO', '$ingr', '$co')";

    if (!$conn->query($sql)) {
        error_log("Error en la consulta SQL: " . $sql . " - Error: " . $conn->error);
        echo "Error en la consulta SQL: " . $sql . " - Error: " . $conn->error;
        exit();
    }
}

echo "Cintas agregadas exitosamente";
$conn->close();
?>
