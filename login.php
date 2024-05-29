<?php
$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv_00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se enviaron datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Escapar caracteres especiales para evitar inyección SQL
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Consulta para buscar el usuario en la tabla 'usuarios'
    $sql = "SELECT id, username, role FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Usuario encontrado, iniciar sesión
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION["id"] = $row["id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["role"] = $row["role"];

        // Redireccionar a la página de inicio o a donde sea necesario
        header("Location: welcome.php");
        exit();
    } else {
        // Usuario no encontrado, mostrar mensaje de error
        echo "Usuario o contraseña incorrectos";
    }
}

// Cerrar conexión MySQL
$conn->close();
?>
