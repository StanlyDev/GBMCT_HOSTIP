<?php
$target_dir = "/var/www/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$message = ''; // Variable para almacenar el mensaje

try {
    // Verifica si se ha enviado un archivo
    if (!isset($_FILES["file"])) {
        throw new Exception("No se ha recibido ningún archivo.");
        header("Location: /Frontend/Pages/UpdateFile.php");
        exit();
    }

    // Verifica si hubo errores en la subida
    if ($_FILES["file"]["error"] != UPLOAD_ERR_OK) {
        throw new Exception("Error al subir el archivo.");
        header("Location: /Frontend/Pages/UpdateFile.php");
        exit();
    }

    // Verifica si el archivo ya existe
    if (file_exists($target_file)) {
        throw new Exception("El archivo ya existe.");
        header("Location: /Frontend/Pages/UpdateFile.php");
        exit();
    }

    // Verifica el tamaño del archivo (máximo 5MB en este ejemplo)
    if ($_FILES["file"]["size"] > 5000000) {
        throw new Exception("El archivo es demasiado grande.");
        header("Location: /Frontend/Pages/UpdateFile.php");
        exit();
    }

    // Permitir ciertos formatos de archivo (opcional)
    $allowed_types = array("jpg", "png", "jpeg", "gif", "pdf", "docx", "xlsx", "xlsm");
    if (!in_array($imageFileType, $allowed_types)) {
        throw new Exception("Solo se permiten archivos JPG, JPEG, PNG, GIF, PDF, DOCX, XLSM y XLSX.");
        header("Location: /Frontend/Pages/UpdateFile.php");
        exit();
    }

    // Intenta mover el archivo subido al directorio de destino
    if (!move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        throw new Exception("Error al mover el archivo al directorio de destino.");
        header("Location: /Frontend/Pages/UpdateFile.php");
        exit();
    }

    // Éxito al subir el archivo
    $message = "success";
} catch (Exception $e) {
    $message = $e->getMessage(); // Captura y almacena el mensaje de error
}

// Codifica el mensaje para JavaScript
$message_encoded = json_encode($message);
?>
