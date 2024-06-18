<?php
session_start();

// Si el formulario es enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo = $_POST['codigo'] ?? '';

    // Definir el código correcto
    $codigo_correcto = '1234'; // Cambia esto por el código que quieras usar

    if ($codigo === $codigo_correcto) {
        $_SESSION['validated'] = true;
        header("Location: /Pages/DeleteInvent.php");
        exit();
    } else {
        $error = "Código incorrecto. Inténtalo de nuevo.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/CSS/validate_code.css">
  <title>Validar Código</title>
</head>
<body>
  <div class="validation-container">
    <h2>Ingrese el Código de Validación</h2>
    <form method="post" action="">
      <input type="text" name="codigo" maxlength="4" required>
      <button type="submit">Validar</button>
      <?php if (isset($error)): ?>
        <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>