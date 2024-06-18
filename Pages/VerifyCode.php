<?php
session_start();
// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <link rel="stylesheet" href="/CSS/validate_code.css">
</head>
<body>
    <h1>Verificar Código</h1>
    <!-- Aquí puedes colocar el formulario o la lógica para verificar el código -->
    <form action="/php/process_verify_code.php" method="POST">
        <label for="codigo">Ingrese el código a verificar:</label><br>
        <input type="text" id="codigo" name="codigo" required><br>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
