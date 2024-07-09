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

// Obtener los datos del formulario
$nombreCliente = $_POST['client_name'];
$contrato = $_POST['co'];
$ticketSR = $_POST['sr'];
$fdmEmail = $_POST['enc'];
$horaIngreso = $_POST['hrEsti'];
$fechaIngreso = $_POST['FechaIO'];
$agregadoPor = $_POST['ingr'];
$tipoCinta = $_POST['TypeCinta'];
$descripcion = $_POST['DesCin'];
$codigoCinta = $_POST['CCinta'];
$codigoCintaInter = $_POST['CCintaInter'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO TableInventory (NombreCliente, TipoCinta, Descripcion, CdClient, TickectSR, FDMEmail, HrAdd, DateAdd, OperatorName, CO, CdInter) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssss", $nombreCliente, $tipoCinta, $descripcion, $codigoCinta, $ticketSR, $fdmEmail, $horaIngreso, $fechaIngreso, $agregadoPor, $contrato, $codigoCintaInter);

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
