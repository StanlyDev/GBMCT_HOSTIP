<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo "Error en la decodificación del JSON: " . json_last_error_msg();
    exit();
}

if (empty($data)) {
    echo "No se recibieron datos.";
    exit();
}

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

    $sql = "INSERT INTO TableInventory (NombreCliente, CO, TicketSR, FDMEmail, HrAdd, DateAdd, OperatorName, TipoCinta, Descripcion, CodigoCinta)
            VALUES ('$client_name', '$co', '$sr', '$enc', '$hrEsti', '$FechaIO', '$ingr', '$TypeCinta', '$DesCin', '$CCinta')";

    if (!$conn->query($sql)) {
        echo "Error en la consulta SQL: " . $sql . "<br>" . $conn->error;
        exit();
    }
}

echo "Cintas agregadas exitosamente";
$conn->close();
?>
