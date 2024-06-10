<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "10.4.27.116";
    $username = "stanvsdev";
    $password = "Stanlyv00363";
    $dbname = "dbmedios_gbm";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $userId = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    $sql = "UPDATE usuarios SET username='$name', email='$email', role='$role', password='$password' WHERE id=$userId";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error al actualizar el usuario: " . $conn->error;
    }

    $conn->close();
}
?>
