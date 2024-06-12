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

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Iterar sobre las filas de la tabla HTML
foreach ($_POST['data'] as $row) {
    $nombreCliente = $row[0];
    $tipoCinta = $row[1];
    $descripcion = $row[2];
    $codigoCinta = $row[3];
    $tickectSR = $row[4];
    $fdmEmail = $row[5];
    $hrAdd = $row[6];
    $dateAdd = $row[7];
    $operatorName = $row[8];
    $co = $row[9];

    // Preparar la consulta SQL
    $sql = "INSERT INTO TableInventory (NombreCliente, TipoCinta, Descripcion, CodigoCinta, TickectSR, FDMEmail, HrAdd, DateAdd, OperatorName, CO)
    VALUES ('$nombreCliente', '$tipoCinta', '$descripcion', '$codigoCinta', '$tickectSR', '$fdmEmail', '$hrAdd', '$dateAdd', '$operatorName', '$co')";

    // Ejecutar la consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Los datos se agregaron correctamente a la base de datos.";
    } else {
        echo "Error al insertar datos: " . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>