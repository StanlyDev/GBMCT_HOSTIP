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

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Leer los datos enviados en el cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    foreach ($data as $row) {
        $NumeroCinta = $row['NumeroCinta'];
        $NombreCliente = $row['NombreCliente'];
        $TipoCinta = $row['TipoCinta'];
        $Descripcion = $row['Descripcion'];
        $CodigoCinta = $row['CodigoCinta'];
        $TickectSR = $row['TickectSR'];
        $HrAdd = $row['HrAdd'];
        $DateAdd = $row['DateAdd'];
        $FDMEmail = $row['FDMEmail'];
        $OperatorName = $row['OperatorName'];
        $CO = $row['CO'];

        $sql = "INSERT INTO TableInventory (
            NumeroCinta,
            NombreCliente,
            TipoCinta,
            Descripcion,
            CodigoCinta,
            TickectSR,
            HrAdd,
            DateAdd,
            FDMEmail,
            OperatorName,
            CO
        ) VALUES (
            '$NumeroCinta',
            '$NombreCliente',
            '$TipoCinta',
            '$Descripcion',
            '$CodigoCinta',
            '$TickectSR',
            '$HrAdd',
            '$DateAdd',
            '$FDMEmail',
            '$OperatorName',
            '$CO'
        )";

        if (!$conn->query($sql)) {
            echo json_encode(['success' => false, 'error' => $conn->error]);
            exit;
        }
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'No data received']);
}

$conn->close();
?>