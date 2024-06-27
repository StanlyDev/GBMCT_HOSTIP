<?php
session_start();

// Verificar si el usuario no ha iniciado sesión o no tiene el rol adecuado
if (!isset($_SESSION["id"]) || ($_SESSION["role"] !== 'root' && $_SESSION["role"] !== 'admin')) {
    header("Location: /index.html");
    exit();
}

$usuario_rol = $_SESSION["role"] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Frontend/CSS/create_user.css">
    <link rel="shortcut icon" href="/Frontend/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/Backend/JavaScript/script.js"></script>
    <script defer src="/Backend/JavaScript/windowsDoc.js"></script>
    <script defer src="/Backend/JavaScript/HistoAlert.js"></script>
    <script defer src="/Backend/JavaScript/logout.js"></script>
    <script defer src="/Backend/JavaScript/get_user.js"></script>
    <script defer src="/Backend/JavaScript/save_user.js"></script>
    <title>GBM | CT</title>
</head>
<body>
    <div class="overlay"></div>
    <!--Inicio Cabecera-->
    <header>
        <div class="menu-btn" onclick="toggleMenu()">☰</div>
        <div class="logo"><img src="/Frontend/IMG/Logos/Logo-blanco-sin-fondo.png"></div>
        <div class="icon-container">
        <div class="home"><a href="#" title="Inicio"><script src="https://cdn.lordicon.com/lordicon.js"></script>
        <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/hrjifpbq.json"
                    trigger="hover"
                    colors="primary:#ffffff"
                    style="width:30px;height:30px">
                </lord-icon></a><p style="float: right; color: white; padding: 5px;"><?php echo $_SESSION["username"]; ?></p></div>
            <div class="home">
                <a href="/Frontend/Pages/HomePage.php" title="Inicio">
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/wmwqvixz.json"
                    trigger="morph"
                    state="morph-home-3"
                    colors="primary:#ffffff"
                    style="width:30px;height:30px">
                </lord-icon></a></div>
                <div class="close_user">
                <a href="/Backend/php/logout.php" title="Inicio">
                    <script src="https://cdn.lordicon.com/lordicon.js"></script>
                    <lord-icon
                        src="https://cdn.lordicon.com/eoacwhtz.json"
                        trigger="hover"
                        stroke="bold"
                        colors="primary:#ffffff,secondary:#02092b,tertiary:#02092b,quaternary:#02092b,quinary:#02092b,senary:#02092b,septenary:#ffffff"
                        style="width:30px;height:30px">
                    </lord-icon>
                </a>
                </div>
        <!--Inicio Menu-->
        <nav class="navbar"><br>
            <button class="close-btn" onclick="toggleMenu()">✕</button><br><br>
            <ul>
                <a href="/Frontend/Pages/inventory.php"><li><img src="/Frontend/IMG/Icon/box2-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Inventario en Cintoteca</li></a>
                <a href="#" class="histo" onclick="histoAlert()"><li><img src="/Frontend/IMG/Icon/arrow-counterclockwise.svg" style="margin-right: 10px; width: 20px; float: left;">Historial I/O</li></a>
                <a href="#" class="generate-doc" onclick="showOptions()"><li><img src="/Frontend/IMG/Icon/file-earmark-text-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Generar Documento</li></a>
                <a href="/Frontend/Pages/UpdateFile.php"><li><img src="/Frontend/IMG/Icon/cloud-arrow-up-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Subir Archivo</li></a>
                <?php if ($usuario_rol === 'root' || $usuario_rol === 'admin'): ?>
                <a href="/Frontend/Pages/create_user.php"><li><img src="/Frontend/IMG/Icon/person-circle.svg" style="margin-right: 10px; width: 20px; float: left;">Crear Usuario</li></a>
                <?php endif; ?>            
            </ul>
        </nav>
        <!--Fin Menu-->
    </header>
    <div class="container">
        <div class="form-container">
            <h1>Crear Usuario</h1><hr>
            <form id="createUserForm" onsubmit="saveUser(event)">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter user name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter user email" required>
                </div>
                <div>
                    <label for="role">Rol</label>
                    <select id="role" name="role" required>
                        <option value="admin">admin</option>
                        <option value="operator" selected>operador</option>
                        <option value="root">root</option>
                    </select>
                </div>
                <div>
                    <label for="password">Password: <em>GBM123</em></label>
                    <input type="password" id="password" name="password" value="GBM123" readonly>
                </div>
                <button type="submit">Crear Usuario</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre del usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                <tbody id="userTableBody">
                    <!-- Dynamic content will be inserted here -->
                </tbody>
            </table>
        </div>
</div>
<div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeOptions()">&times;</span>
            <p>Elige una opción:</p><hr>
            <a href="/Frontend/Pages/IngresoDeMedios.php">Ingreso de Medios</a>
            <a href="/Frontend/Pages/SalidaDeMedios.php">Salida de Medios</a>
        </div>
    </div>
    <div id="inactivityModal" class="modal">
        <div class="modal-content">
            <p>En <span id="inactivityCountdown">25</span> segundos se cerrará la sesión.</p>
            <button id="continueSessionBtn">Continuar sesión</button>
        </div>
    </div>
</body>
</html>
