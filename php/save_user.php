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

    $name = $_POST["name"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $password = $_POST["password"];

    $sql = "INSERT INTO usuarios (username, email, role, password) VALUES ('$name', '$email', '$role', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error al agregar el usuario: " . $conn->error;
    }

    $conn->close();
}
?>
