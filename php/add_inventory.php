<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

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

$sql = "INSERT INTO inventory (client_name, co, sr, enc, hrEsti, FechaIO, ingr, TypeCinta, DesCin, CCinta)
        VALUES ('$client_name', '$co', '$sr', '$enc', '$hrEsti', '$FechaIO', '$ingr', '$TypeCinta', '$DesCin', '$CCinta')";

if ($conn->query($sql) === TRUE) {
    echo "Cinta agregada exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
