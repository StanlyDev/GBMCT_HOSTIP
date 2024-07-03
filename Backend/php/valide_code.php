<?php
session_start();
require(__DIR__ . '/conexion.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$codigo = $data['CodigoCinta'];

$stmt = $conn->prepare("SELECT COUNT(*) FROM TableInventory WHERE CodigoCinta = ?");
$stmt->bind_param("s", $codigo);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

echo json_encode(['exists' => $count > 0]);
?>
