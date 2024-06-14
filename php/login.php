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

// Inicializar mensaje de error vacío
$errorMsg = "";

// Verificar si se enviaron datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Escapar caracteres especiales para evitar inyección SQL
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Consulta para buscar el usuario en la tabla 'usuarios' por correo electrónico
    $sql = "SELECT id, username, email, password, first_login FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Usuario encontrado, verificar la contraseña
        $row = $result->fetch_assoc();
        $stored_hash = $row["password"];

        if (password_verify($password, $stored_hash)) {
            // Contraseña válida, iniciar sesión
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["username"] = $row["username"];

            if ($row["first_login"]) {
                // Es el primer inicio de sesión, redirigir a la página para cambiar contraseña
                $_SESSION["first_login"] = true;
                header("Location: /change_password.php");
                exit();
            } else {
                // No es el primer inicio de sesión, redirigir a la página de inicio
                header("Location: /Pages/HomePage.php");
                exit();
            }
        } else {
            // Contraseña incorrecta
            $errorMsg = "Usuario o contraseña incorrectos";
        }
    } else {
        // Usuario no encontrado
        $errorMsg = "Usuario o contraseña incorrectos";
    }
}

// Cerrar conexión MySQL
$conn->close();
?>