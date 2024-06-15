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

// Consulta para buscar el usuario en la tabla 'usuarios' por correo electrónico
$sql = "SELECT id, username, email, role, password, first_login FROM usuarios WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Usuario encontrado, verificar la contraseña
    $row = $result->fetch_assoc();
    $stored_hash = $row["password"];

    // Verificar la contraseña ingresada con el hash almacenado
    if (password_verify($password, $stored_hash)) {
        // Contraseña correcta, iniciar sesión
        $_SESSION["id"] = $row["id"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["role"] = $row["role"];
        $_SESSION["username"] = $row["username"];

        if ($row["first_login"]) {
            // Es el primer inicio de sesión, redirigir a la página para cambiar contraseña
            $_SESSION["first_login"] = true;
            header("Location: /Pages/change_password.php");
            exit();
        } else {
            // No es el primer inicio de sesión, redirigir a la página de inicio
            header("Location: /Pages/HomePage.php");
            exit();
        }
    } else {
        // Contraseña incorrecta
        $_SESSION["errorMsg"] = "Usuario o contraseña incorrectos";
        header("Location: /index.html"); // Redireccionar al formulario de inicio de sesión
        exit();
    }
} else {
    // Usuario no encontrado
    $_SESSION["errorMsg"] = "Usuario o contraseña incorrectos";
    header("Location: /index.html"); // Redireccionar al formulario de inicio de sesión
    exit();
}


// Cerrar conexión MySQL
$conn->close();
?>
