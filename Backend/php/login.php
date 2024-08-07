<?php
session_start();

$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $errorMsg = "";
    $email = $conn->real_escape_string($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT id, username, email, role, password, first_login FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verificar contraseña predeterminada y primera vez de inicio de sesión
        if ($password == "GBM123" && $row["first_login"] == 0) {
            // Contraseña predeterminada encontrada pero first_login no es 1
            $_SESSION["errorMsg"] = "Contraseña predeterminada ya no es válida o contraseña ya fue cambiada";
            header("Location: /index.html"); // Redirige a la página de inicio de sesión con el mensaje de error
            exit();
        }

        // Verificar contraseña
        if ($password == "GBM123") {
            // Contraseña predeterminada encontrada, iniciar sesión y redirigir a cambiar contraseña
            $_SESSION["id"] = $row["id"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["first_login"] = true; // Marcar como primer inicio de sesión

            header("Location: /Frontend/Pages/change_password.php"); // Ajusta la ruta según tu estructura de archivos
            exit();
        } else {
            // Contraseña no predeterminada, verificar la contraseña almacenada
            $stored_hash = $row["password"];
            if (password_verify($password, $stored_hash)) {
                $_SESSION["id"] = $row["id"];
                $_SESSION["email"] = $row["email"];
                $_SESSION["role"] = $row["role"];
                $_SESSION["username"] = $row["username"];

                if ($row["first_login"] == 1) {
                    $_SESSION["first_login"] = true;
                    header("Location: /Frontend/Pages/change_password.php"); // Ajusta la ruta según tu estructura de archivos
                    exit();
                } else {
                    header("Location: /Frontend/Pages/HomePage.php"); // Ajusta la ruta según tu estructura de archivos
                    exit();
                }
            } else {
                $_SESSION["errorMsg"] = "Usuario o contraseña incorrectos";
                header("Location: /index.html");
                exit();
            }
        }
    } else {
        $_SESSION["errorMsg"] = "Usuario o contraseña incorrectos";
        header("Location: /index.html");
        exit();
    }

    $conn->close();
} else {
    header("Location: /index.html");
    exit();
}
?>
