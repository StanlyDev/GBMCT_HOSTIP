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

$data = json_decode(file_get_contents('php://input'), true);

foreach ($data as $cinta) {
    $client_name = $cinta['client_name'];
    $co = $cinta['co'];
    $sr = $cinta['sr'];
    $enc = $cinta['enc'];
    $hrEsti = $cinta['hrEsti'];
    $FechaIO = $cinta['FechaIO'];
    $ingr = $cinta['ingr'];
    $TypeCinta = $cinta['TypeCinta'];
    $DesCin = $cinta['DesCin'];
    $CCinta = $cinta['CCinta'];

    $sql = "INSERT INTO inventory (client_name, co, sr, enc, hrEsti, FechaIO, ingr, TypeCinta, DesCin, CCinta)
            VALUES ('$client_name', '$co', '$sr', '$enc', '$hrEsti', '$FechaIO', '$ingr', '$TypeCinta', '$DesCin', '$CCinta')";

    if (!$conn->query($sql)) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit();
    }
}

echo "Cintas agregadas exitosamente";
$conn->close();
?>
