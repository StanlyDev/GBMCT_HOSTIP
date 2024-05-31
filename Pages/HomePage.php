<?php
session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/JavaScript/script.js"></script>
    <script defer src="/JavaScript/windowsDoc.js"></script>
    <script defer src="/JavaScript/HistoAlert.js"></script>
    <script defer src="/JavaScript/logout.js"></script>
    <title>GBM | CT</title>
</head>
<body>
    <div class="overlay"></div>
    <!--Inicio Cabecera-->
    <header>
        <div class="menu-btn" onclick="toggleMenu()">☰</div>
        <div class="logo"><img src="/IMG/Logos/Logo-blanco-sin-fondo.png"></div>
        <div class="icon-container">
            <div class="home"><a href="/Pages/HomePage.php"><script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/wmwqvixz.json"
                    trigger="morph"
                    state="morph-home-3"
                    colors="primary:#ffffff"
                    style="width:30px;height:30px">
                </lord-icon></a></div>
            <div class="close_user"><a href="/index.html"><script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/eoacwhtz.json"
                    trigger="hover"
                    stroke="bold"
                    colors="primary:#ffffff,secondary:#02092b,tertiary:#02092b,quaternary:#02092b,quinary:#02092b,senary:#02092b,septenary:#ffffff"
                    style="width:30px;height:30px">
                </lord-icon></a></div>
        </div>
        <!--Inicio Menu-->
        <nav class="navbar"><br>
            <button class="close-btn" onclick="toggleMenu()">✕</button><br><br>
            <ul>
                <a href="/Pages/inventory.php"><li><img src="/IMG/Icon/box2-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Inventario en Cintoteca</li></a>
                <a href="#" class="histo" onclick="histoAlert()"><li><img src="/IMG/Icon/arrow-counterclockwise.svg" style="margin-right: 10px; width: 20px; float: left;">Historial I/O</li></a>
                <a href="#" class="generate-doc" onclick="showOptions()"><li><img src="/IMG/Icon/file-earmark-text-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Generar Documento</li></a>
                <a href="/Pages/create_user.php"><li><img src="/IMG/Icon/person-circle.svg" style="margin-right: 10px; width: 20px; float: left;">Crear Usuario</li></a>
            </ul>
        </nav>
        <!--Fin Menu-->
    </header>
    <!--Fin Cabecera-->
    <main>
        <!--Inicio Main-->
        <div class="VMV">
            <h1>Visión:</h1>
            <p>Ser los mejores proveedores de soluciones de TI de nuestros clientes para mejorar su competitividad, con el propósito de duplicar el negocio y la rentabilidad en 5 años, en un clima organizacional óptimo, innovador y colaborativo con las comunidades donde operamos</p>
        </div>
        <div class="VMV">
            <h1>Misión:</h1>
            <p>Integrar la tecnología en soluciones de valor agregado que satisfagan las expectativas de nuestros clientes, a través de profesionales calificados y comprometidos, con metodologías, productos y servicios de clase mundial.</p>
        </div>
        <div class="VMV">
            <h1>Valores:</h1>
            <p>
                <ul>
                    <li><b>Confiabilidad:</b> Ser honestos, íntegros y leales, ejecutando nuestros compromisos con alta calidad, precisión y puntualidad.</li>
                    <li><b>Coraje:</b> Sinónimo de atrevimiento. Ser los más genuinos, persistentes y productivos.</li>
                    <li><b>Disciplina:</b> Observancia y cumplimiento de las reglas y compromisos.</li>
                    <li><b>Transparencia:</b> Ser claro, evidente, sin duda ni ambigüedad.</li>
                </ul>
            </p>
        </div>
        <!--Fin Main-->
    </main>
    <!-- Ventana emergente -->
    <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeOptions()">&times;</span>
          <p>Elige una opción:</p><hr>
          <a href="/Pages/IngresoDeMedios.php">Ingreso de Medios</a>
          <a href="/Pages/SalidaDeMedios.php">Salida de Medios</a>
        </div>
      </div>
    </div>
</body>
</html>