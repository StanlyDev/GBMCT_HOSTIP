<?php
session_start();

// Verificar si el usuario está autenticado y es su primer inicio de sesión
if (!isset($_SESSION["id"]) || !isset($_SESSION["first_login"]) || !$_SESSION["first_login"]) {
    header("Location: /index.html"); // Redirigir a la página de inicio de sesión si no está autenticado
    exit();
}

// Incluir el archivo de configuración de la base de datos o establecer la conexión aquí
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

// Procesar el cambio de contraseña si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST["new_password"];

    // Validar y procesar el cambio de contraseña aquí
    // Recuerda asegurar la contraseña antes de almacenarla en la base de datos
    // Puedes usar funciones como password_hash() en PHP para hacerlo seguro
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    $user_id = $_SESSION["id"];

    // Actualizar la contraseña en la base de datos y marcar first_login como FALSE
    $sql = "UPDATE usuarios SET password = ?, first_login = FALSE WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $hashed_password, $user_id);
    $stmt->execute();
    $stmt->close();

    // Redirigir al usuario a la página de inicio
    header("Location: /Pages/HomePage.php");
    exit();
}

// Cerrar conexión MySQL al finalizar
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar contraseña</title>
</head>
<body>
    <h2>Cambiar contraseña</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        Nueva contraseña: <input type="password" name="new_password" required><br><br>
        <input type="submit" value="Cambiar contraseña">
    </form>
</body>
</html>

<?php
// Cerrar conexión MySQL al finalizar
$conn->close();
?>
