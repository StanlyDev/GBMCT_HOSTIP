<?php
$target_dir = "/var/www/uploads/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verifica si el archivo ya existe
if (file_exists($target_file)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
}

// Verifica el tamaño del archivo (máximo 5MB en este ejemplo)
if ($_FILES["file"]["size"] > 5000000) {
    echo "Lo siento, el archivo es demasiado grande.";
    $uploadOk = 0;
}

// Permitir ciertos formatos de archivo (opcional)
$allowed_types = array("jpg", "png", "jpeg", "gif", "pdf", "docx", "xlsx", "xlsm");
if (!in_array($imageFileType, $allowed_types)) {
    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG, GIF, PDF, DOCX , XLSM y XLSX.";
    $uploadOk = 0;
}

// Verifica si $uploadOk es 0 por un error
if ($uploadOk == 0) {
    echo "Lo siento, tu archivo no fue subido.";
} else {
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "El archivo ". htmlspecialchars(basename($_FILES["file"]["name"])). " ha sido subido.";
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}
?>