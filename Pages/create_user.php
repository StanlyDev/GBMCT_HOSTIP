<?php
session_start();

// Verificar si el usuario ha iniciado sesión y tiene el rol de "root" o "admin", de lo contrario, redirigirlo al formulario de inicio de sesión
if (!isset($_SESSION["role"]) || ($_SESSION["role"] !== "root" && $_SESSION["role"] !== "admin")) {
    header("Location: /index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/create_user.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/JavaScript/script.js"></script>
    <script defer src="/JavaScript/windowsDoc.js"></script>
    <script defer src="/JavaScript/HistoAlert.js"></script>
    <script defer src="/JavaScript/logout.js"></script>
    <script defer src="/JavaScript/addUser.js"></script>
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
    <div class="container">
        <div class="form-container">
            <h1>Crear Usuario</h1><hr>
            <form id="createUserForm">
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
                        <option value="admin">Administrador</option>
                        <option value="operator" selected>Operador</option>
                        <option value="root">Root</option>
                    </select>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter user password" required>
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