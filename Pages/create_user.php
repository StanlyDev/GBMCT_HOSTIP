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
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="/CSS/Index.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
</head>
<body>
    <div class="container">
        <form id="createUserForm" method="POST" action="/php/create_user.php">
            <h2>Crear Nuevo Usuario</h2>
            <label for="newUsername">Usuario:</label>
            <input type="text" id="newUsername" name="username" required>
            <br>
            <label for="newEmail">Correo:</label>
            <input type="email" id="newEmail" name="email" required>
            <br>
            <label for="newPassword">Contraseña:</label>
            <input type="password" id="newPassword" name="password" required>
            <br>
            <label for="newRole">Rol:</label>
            <select id="newRole" name="role" required>
                <option value="operador">Operador</option>
                <option value="admin">Administrador</option>
            </select>
            <br>
            <button type="submit">Crear Usuario</button>
        </form>
    </div>
</body>
<!-- Developed by Brandon Ventura -->
</html>
