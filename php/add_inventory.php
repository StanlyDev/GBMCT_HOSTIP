<?php
session_start();
// Establecer conexión con la base de datos
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario (suponiendo que están enviados por POST)
$NumeroCinta = $_POST['NumeroCinta'];
$NombreCliente = $_POST['NombreCliente'];
$TipoCinta = $_POST['TipoCinta'];
$Descripcion = $_POST['Descripcion'];
$CodigoCinta = $_POST['CodigoCinta'];
$EnCintoteca = $_POST['EnCintoteca'];
$TickectSR = $_POST['TickectSR'];
$FDMEmail = $_POST['FDMEmail'];
$HrAdd = $_POST['HrAdd'];
$DateAdd = $_POST['DateAdd'];
$OperatorName = $_POST['OperatorName'];
$CO = $_POST['CO'];

// Preparar la consulta SQL
$sql = "INSERT INTO TableInventory (NumeroCinta, NombreCliente, TipoCinta, Descripcion, CodigoCinta, EnCintoteca, TickectSR, FDMEmail, HrAdd, DateAdd, OperatorName, CO) 
        VALUES ('$NumeroCinta', '$NombreCliente', '$TipoCinta', '$Descripcion', '$CodigoCinta', '$EnCintoteca', '$TickectSR', '$FDMEmail', '$HrAdd', '$DateAdd', '$OperatorName', '$CO')";

if ($conn->query($sql) === TRUE) {
    echo "Nuevo registro agregado correctamente.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$conn->close();
?>
