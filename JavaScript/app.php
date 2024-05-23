<?php
// Configurar conexión a la base de datos
$servername = "10.4.27.79";
$username = "stanvsdev";
$password = "Stanlyvs_00363";
$database = "gbmct_db";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Realizar consulta a la base de datos
$sql = "SELECT * FROM InventarioCintas"; // Reemplaza 'nombre_de_la_tabla' con el nombre real de tu tabla
$result = $conn->query($sql);

// Cerrar conexión
$conn->close();
?>
