<?php
$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv_00363";
$dbname = "dbmedios_gbm";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT NumeroCinta, NombreCliente, TipoCinta, Descripcion, CodigoCinta, EnCintoteca FROM TableInventory";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
