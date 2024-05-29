<?php
session_start(); // Iniciar sesión

// Comprobar si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Conexión a la base de datos
    $servername = "10.4.27.113";
    $username = "stanvsdev";
    $password = "Stanlyv_00363";
    $dbname = "dbmedios_gbm";

    // Crear conexión
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if ($result->num_rows > 0) {
        // Iniciar sesión y redirigir al usuario a la página de inicio
        $_SESSION['username'] = $username;
        header("Location: /Pages/HomePage.html"); // Cambia 'inicio.php' por la página a la que deseas redirigir al usuario
    } else {
        // Mostrar mensaje de error si las credenciales son incorrectas
        echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }

    // Cerrar conexión a la base de datos
    $conn->close();
}
?>
