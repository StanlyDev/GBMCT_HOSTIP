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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/CSS/Index.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/JavaScript/displayscript.js"></script>
</head>
<body style="background: url('/IMG/Back/IdxBack.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;">
    <div class="container">
        <form id="loginForm" method="POST" action="/login.php">
            <h2>GBM | CT</h2>
            <label for="email">Correo:</label>
            <input type="email" id="email" name="email" required style="color: white;">
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required style="color: white;">
            <br>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p id="message" style="color: red;"><?php echo $errorMsg; ?></p>
    </div>
</body>
<!-- Developed by Brandon Ventura -->
</html>