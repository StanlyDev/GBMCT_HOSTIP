<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "10.4.27.113";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $userId = $_POST["id"];
    
    $sql = "DELETE FROM usuarios WHERE id = $userId";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario eliminado exitosamente.";
    } else {
        echo "Error al eliminar el usuario: " . $conn->error;
    }

    $conn->close();
}
?>
