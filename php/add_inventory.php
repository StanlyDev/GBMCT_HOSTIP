<?php
// Conectar a la base de datos
$servername = "10.4.27.116";
$username = "stanvsdev";
$password = "Stanlyv00363";
$dbname = "dbmedios_gbm";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $client_name = $_POST['client_name'];
    $co = $_POST['co'];
    $sr = $_POST['sr'];
    $enc = $_POST['enc'];
    $hrEsti = $_POST['hrEsti'];
    $FechaIO = $_POST['FechaIO'];
    $ingr = $_POST['ingr'];
    $TypeCinta = $_POST['TypeCinta'];
    $DesCin = $_POST['DesCin'];
    $CCinta = $_POST['CCinta'];

    // Insertar datos en la base de datos
    $sql = "INSERT INTO TableInventory (Cliente, Contrato, TicketIngreso, EmailFieldManager, HoraIngreso, FechaIngreso, AgregadaPor, Tipo, Descripcion, Codigo) 
            VALUES ('$client_name', '$co', '$sr', '$enc', '$hrEsti', '$FechaIO', '$ingr', '$TypeCinta', '$DesCin', '$CCinta')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar conexión
$conn->close();
?>
