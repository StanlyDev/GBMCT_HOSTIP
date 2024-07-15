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
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del usuario desde el parámetro GET
$userId = $conn->real_escape_string($_GET['id']);

// Consulta para obtener la información del usuario
$sql = "SELECT * FROM usuarios WHERE id = $userId";
$result = $conn->query($sql);

// Obtener los datos del usuario
$user = $result->fetch_assoc();

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Frontend/CSS/create_user.css">
    <link rel="shortcut icon" href="/Frontend/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/Backend/JavaScript/logout.js"></script>
    <script defer src="/Backend/JavaScript/secure.js"></script>
    <title>Editar Usuario</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Editar Usuario</h1>
            <hr>
            <form id="editUserForm">
                <div>
                    <label for="name">Nombre</label>
                    <input type="text" id="name" name="name" value="<?php echo $user['username']; ?>" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
                <div>
                    <label for="role">Rol</label>
                    <select id="role" name="role" required>
                        <option value="admin" <?php echo $user['role'] == 'admin' ? 'selected' : ''; ?>>admin</option>
                        <option value="operator" <?php echo $user['role'] == 'operator' ? 'selected' : ''; ?>>operador</option>
                        <option value="root" <?php echo $user['role'] == 'root' ? 'selected' : ''; ?>>root</option>
                    </select>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <small>Deja en blanco para mantener la contraseña actual</small>
                </div>
                <button type="submit">Guardar Cambios</button>
                <button style="background-color: red;" type="button" id="deleteButton" onclick="deleteUser(<?php echo $userId; ?>)">Eliminar Usuario</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('editUserForm').onsubmit = function(event) {
            event.preventDefault();
            var formData = new FormData(event.target);
            formData.append('id', <?php echo $userId; ?>);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/Backend/php/update_user.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Usuario actualizado exitosamente.");
                    window.location.href = "/Frontend/Pages/create_user.php";
                }
            };
            xhr.send(formData);
        };

        function deleteUser(userId) {
            if (confirm("¿Estás seguro de que quieres eliminar este usuario?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "/Backend/php/delete_user.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert("Usuario eliminado exitosamente.");
                        window.location.href = "/Frontend/Pages/create_user.php";
                    }
                };
                xhr.send("id=" + userId);
            }
        }
    </script>
</body>
<!--Develop By Brandon Ventura | StanlyDev -->
</html>
