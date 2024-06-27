<?php
// Directorio donde se encuentran los archivos subidos
$upload_dir = "/var/www/uploads/";

// Nombre del archivo que se desea descargar
$file_name = $_GET['file'] ?? ''; // Recupera el nombre del archivo desde la solicitud GET

// Verificar que el nombre del archivo no esté vacío
if (empty($file_name)) {
    die("Nombre de archivo no proporcionado.");
}

// Ruta completa del archivo
$file_path = $upload_dir . $file_name;

// Verificar si el archivo existe
if (!file_exists($file_path)) {
    die("El archivo no existe en el servidor.");
}

// Configurar encabezados para la descarga
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
header('Content-Length: ' . filesize($file_path));

// Leer el archivo y enviarlo al navegador
readfile($file_path);
exit;
?>
