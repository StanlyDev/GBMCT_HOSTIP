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

// Preparar y ejecutar consulta SQL
$sql = "SELECT id, NombreCliente, TipoCinta, Descripcion, CdClient, Ubicacion FROM TableInventory";
$result = $conn->query($sql);

// Verificar si la consulta se ejecutó correctamente
if ($result === false) {
    die("Error al ejecutar la consulta: " . $conn->error);
}

// Procesar resultados de la consulta
$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 resultados";
}

// Cerrar conexión MySQL
$conn->close();

// Establecer el encabezado de respuesta JSON
header('Content-Type: application/json');

// Generar y devolver respuesta JSON
echo json_encode($data);
?>
