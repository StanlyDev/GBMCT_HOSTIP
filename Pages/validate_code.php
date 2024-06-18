<?php
session_start();
require 'path/to/PHPMailer/PHPMailerAutoload.php'; // Asegúrate de tener PHPMailer instalado y configurado

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

// Si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = $_POST['codigo'] ?? '';
    $user_id = $_SESSION['id'];

    // Verificar el código en la base de datos
    $sql = "SELECT Code_Temp FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $codigo_correcto = $row['Code_Temp'];

        if ($codigo === $codigo_correcto) {
            $_SESSION['validated'] = true;
            header("Location: /Pages/DeleteInvent.php");
            exit();
        } else {
            $error = "Código incorrecto. Inténtalo de nuevo.";
        }
    } else {
        $error = "No se encontró el usuario.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/CSS/validate_code.css">
  <title>Validar Código</title>
</head>
<body>
  <div class="validation-container">
    <h2>Ingrese el Código de Validación</h2>
    <form method="post" action="">
      <input type="text" name="codigo" maxlength="4" required>
      <button type="submit">Validar</button>
      <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
