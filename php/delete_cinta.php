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

    // Preparar la consulta SQL con una sentencia preparada
    $sql = "DELETE FROM TableInventory WHERE NumeroCinta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_cinta); // "i" indica que el parámetro es un entero

    // Ejecutar la consulta preparada
    if ($stmt->execute()) {
        echo "La cinta ha sido eliminada correctamente";
    } else {
        echo "Error al eliminar la cinta: " . $stmt->error;
    }

    // Cerrar la sentencia preparada
    $stmt->close();
} else {
    echo "No se proporcionó un ID de cinta para eliminar";
}

// Cerrar conexión
$conn->close();
?>
