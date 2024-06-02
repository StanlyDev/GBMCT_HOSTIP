<?php
session_start();
$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$userId = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = $userId";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/create_user.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <title>Editar Usuario</title>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Editar Usuario</h1><hr>
            <form id="editUserForm">
                <div>
                    <label for="name">Name</label>
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
                    <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                </div>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('editUserForm').onsubmit = function(event) {
            event.preventDefault();
            var formData = new FormData(event.target);
            formData.append('id', <?php echo $userId; ?>);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "/php/update_user.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Usuario actualizado exitosamente.");
                    window.location.href = "/Pages/create_user.php";
                }
            };
            xhr.send(formData);
        };
    </script>
</body>
</html>
