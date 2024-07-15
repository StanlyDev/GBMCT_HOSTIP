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
    <link rel="stylesheet" href="/Frontend/CSS/validate_code.css">
    <script defer src="/Backend/JavaScript/secure.js"></script>
</head>
<body>
    <h1>Verificar Código</h1>
    <!-- Formulario para ingresar el código -->
    <form id="codigoForm" action="/Backend/php/code_gen.php" method="POST">
        <label for="codigo">Ingrese el código a verificar:</label><br>
        <input type="text" id="codigo" name="codigo" required><br>
        <button type="submit" name="enviarCorreo" formnovalidate>Solicitar Código</button>
        <button type="submit" name="verificarCodigo">Verificar</button>
    </form>
</body>
<!--Develop By Brandon Ventura | StanlyDev -->
</html>
