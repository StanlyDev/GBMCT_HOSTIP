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

foreach ($data as $cinta) {
    $client_name = $cinta['client_name'];
    $co = $cinta['co'];
    $sr = $cinta['sr'];
    $enc = $cinta['enc'];
    $hrEsti = $cinta['hrEsti'];
    $FechaIO = $cinta['FechaIO'];
    $ingr = $cinta['ingr'];
    $TypeCinta = $cinta['TypeCinta'];
    $DesCin = $cinta['DesCin'];
    $CCinta = $cinta['CCinta'];

    $sql = "INSERT INTO TableInventory (NombreCliente, CO, TicketSR, FDMEmail, HrAdd, DateAdd, OperatorName, TipoCinta, Descripcion, CodigoCinta)
            VALUES ('$client_name', '$co', '$sr', '$enc', '$hrEsti', '$FechaIO', '$ingr', '$TypeCinta', '$DesCin', '$CCinta')";

    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
    }
}

echo "Cintas agregadas exitosamente";
$conn->close();
?>
