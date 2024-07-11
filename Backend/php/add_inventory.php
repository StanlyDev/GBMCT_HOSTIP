<?php
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario con validación
$nombreCliente = filter_input(INPUT_POST, 'client_name', FILTER_SANITIZE_STRING);
$contrato = filter_input(INPUT_POST, 'co', FILTER_SANITIZE_STRING);
$ticketSR = filter_input(INPUT_POST, 'sr', FILTER_SANITIZE_STRING);
$fdmEmail = filter_input(INPUT_POST, 'enc', FILTER_SANITIZE_EMAIL);
$horaIngreso = filter_input(INPUT_POST, 'hrEsti', FILTER_SANITIZE_STRING);
$fechaIngreso = filter_input(INPUT_POST, 'FechaIO', FILTER_SANITIZE_STRING);
$agregadoPor = filter_input(INPUT_POST, 'ingr', FILTER_SANITIZE_STRING);
$tipoCinta = filter_input(INPUT_POST, 'TypeCinta', FILTER_SANITIZE_STRING);
$descripcion = filter_input(INPUT_POST, 'DesCin', FILTER_SANITIZE_STRING);
$codigoCinta = filter_input(INPUT_POST, 'CCinta', FILTER_SANITIZE_STRING);
$codigoCintaInter = filter_input(INPUT_POST, 'CCintaInter', FILTER_SANITIZE_STRING);
$ubicacion = filter_input(INPUT_POST, 'ubicacion', FILTER_SANITIZE_STRING);

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO TableInventory (NombreCliente, TipoCinta, Descripcion, Ubicacion, CdClient, TickectSR, FDMEmail, HrAdd, DateAdd, OperatorName, CO, CdInter) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssss", $nombreCliente, $tipoCinta, $descripcion, $ubicacion, $codigoCinta, $ticketSR, $fdmEmail, $horaIngreso, $fechaIngreso, $agregadoPor, $contrato, $codigoCintaInter);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['error'] = $stmt->error;
}

$stmt->close();
$conn->close();

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
