<?php
session_start();
require 'conexion.php'; // Asegúrate de que este archivo contiene la configuración de tu conexión a la base de datos

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$codigo = $data['codigo'];

$stmt = $conn->prepare("SELECT COUNT(*) FROM TableInventory WHERE CodigoCinta = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

echo json_encode(['exists' => $count > 0]);
?>
