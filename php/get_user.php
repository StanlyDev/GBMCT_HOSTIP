<?php
session_start();

// Obtener el rol del usuario desde la sesión
$usuario_rol = $_SESSION["role"] ?? '';

// Datos de conexión a la base de datos
$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener todos los usuarios
$sql_select = "SELECT * FROM usuarios";
$resultado = $conn->query($sql_select);

// Verificar si hay resultados
if ($resultado->num_rows > 0) {
    // Generar las filas de la tabla HTML
    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["username"] . "</td>";
        echo "<td>" . $fila["email"] . "</td>";
        echo "<td>" . $fila["role"] . "</td>";
        echo "<td><button class='edit'>Editar</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No se encontraron usuarios</td></tr>";
}

// Cerrar la conexión
$conn->close();
?>
