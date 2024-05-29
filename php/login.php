<?php
$servername = "10.4.27.113";
$username = "stanvsdev";
$password = "Stanlyv_00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Preparar la consulta SQL para prevenir inyecciones SQL
    $stmt = $conn->prepare("SELECT password, role FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashedPassword, $role);
        $stmt->fetch();
        
        // Verificar la contraseña
        if (password_verify($inputPassword, $hashedPassword)) {
            session_start();
            $_SESSION['username'] = $inputUsername;
            $_SESSION['role'] = $role;
            echo json_encode(["success" => true, "message" => "Inicio de sesión exitoso", "role" => $role]);
        } else {
            echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Credenciales incorrectas"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Método no permitido"]);
}

$conn->close();
?>
