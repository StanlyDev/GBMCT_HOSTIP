<?php
session_start();

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

// Consulta SQL para obtener los datos de la tabla
$sql = "SELECT * FROM TableInventory";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $contador = 0; // Inicializamos el contador

    // Salida de datos de cada fila
    while ($row = $result->fetch_assoc()) {
        $contador++; // Incrementamos el contador

        // Agregamos el número secuencial como un campo adicional al resultado
        $row['secuencial'] = $contador;

        // Agregamos la fila al arreglo de resultados
        $data[] = $row;
    }
    echo json_encode($data); // Devolvemos los datos como JSON
} else {
    echo "0 resultados";
}

$conn->close();
?>
