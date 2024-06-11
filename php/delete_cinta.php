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

// Verificar si se ha enviado un ID de cinta para eliminar
if (isset($_POST['id_cinta'])) {
    $id_cinta = $_POST['id_cinta'];

    // Preparar y ejecutar consulta SQL para eliminar la cinta
    $sql = "DELETE FROM TableInventory WHERE NumeroCinta = $id_cinta";
    if ($conn->query($sql) === TRUE) {
        echo "La cinta ha sido eliminada correctamente";
    } else {
        echo "Error al eliminar la cinta: " . $conn->error;
    }
} else {
    echo "No se proporcionó un ID de cinta para eliminar";
}

$conn->close();
?>
