<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo del solicitante desde el formulario
    $emailSolicitante = $_POST['SoliXMail'];

    // Asunto del correo
    $asunto = "Ingreso de Medios";

    // Construir el cuerpo del correo
    $mensaje = "
    <html>
    <head>
        <title>Ingreso de Medios</title>
    </head>
    <body>
        <h1>Detalle del Ingreso de Medios</h1>
        <table border='1'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Descripcion</th>
                    <th>Codigo</th>
                    <th>Ubicacion</th>
                </tr>
            </thead>
            <tbody>
                " . $_POST['tablaHTML'] . "
            </tbody>
        </table>
    </body>
    </html>
    ";

    // Para enviar un correo HTML, debes establecer las cabeceras Content-type
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Cabeceras adicionales
    $headers .= 'From: no-reply@odchonduras.com' . "\r\n";

    // Enviar el correo
    if (mail($emailSolicitante, $asunto, $mensaje, $headers)) {
        echo "Correo enviado exitosamente";
    } else {
        echo "Error al enviar el correo";
    }
}
?>
