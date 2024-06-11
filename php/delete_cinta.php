<?php
// Verificar si se recibió un ID válido para eliminar
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Conexión a la base de datos
    $servername = "10.4.27.116";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y ejecutar consulta SQL para eliminar la fila
    $sql = "DELETE FROM TableInventory WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "La cinta fue eliminada exitosamente";
    } else {
        echo "Error al eliminar la cinta: " . $conn->error;
    }

    // Cerrar conexión MySQL
    $conn->close();
} else {
    echo "ID de cinta no proporcionado";
}
?>
