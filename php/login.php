<?php
session_start();

$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Verificar si se enviaron datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Inicializar mensaje de error vacío
    $errorMsg = "";

    // Obtener y escapar los datos de inicio de sesión
    $email = $_POST["email"];
    $password = $_POST["password"];
    $email = $conn->real_escape_string($email);

    // Consulta para buscar el usuario en la tabla 'usuarios' por correo electrónico
    $sql = "SELECT id, username, email, role, password, first_login FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Usuario encontrado
        $row = $result->fetch_assoc();

        // Verificar la contraseña ingresada
        $stored_hash = $row["password"];

        // Verificar la contraseña utilizando password_verify()
        if (password_verify($password, $stored_hash)) {
            // Contraseña correcta, iniciar sesión
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["username"] = $row["username"];

            if ($row["first_login"] == 1) { // Asumiendo que 'first_login' es un campo booleano (1 para primer inicio de sesión)
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
} else {
    // Si no se envió el formulario correctamente, redirigir a la página de inicio de sesión
    header("Location: /index.html");
    exit();
}
?>
