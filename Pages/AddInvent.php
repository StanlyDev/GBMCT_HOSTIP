<?php
session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}
// Obtener el rol del usuario desde la sesión
$usuario_rol = $_SESSION["role"] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/AddInvent.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/JavaScript/AddInvent.js"></script>
    <script defer src="/JavaScript/windowsDoc.js"></script>
    <script defer src="/JavaScript/HistoAlert.js"></script>
    <script defer src="/JavaScript/logout.js"></script>
    <script defer src="/JavaScript/script.js"></script>
    <title>GBM | CT</title>
</head>
<body>
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
                <div class="close_user">
                <a href="/php/logout.php">
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
        <nav class="navbar">
            <button class="close-btn" onclick="toggleMenu()">✕</button>
            <ul>
                <a href="/Pages/inventory.html"><li><img src="/IMG/Icon/box2-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Inventario en Cintoteca</li></a>
                <a href="#" class="histo" onclick="histoAlert()"><li><img src="/IMG/Icon/arrow-counterclockwise.svg" style="margin-right: 10px; width: 20px; float: left;">Historial I/O</li></a>
                <a href="#" class="generate-doc" onclick="showOptions()"><li><img src="/IMG/Icon/file-earmark-text-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Generar Documento</li></a>
                <?php if ($usuario_rol === 'root' || $usuario_rol === 'admin'): ?>
                <a href="/Pages/create_user.php"><li><img src="/IMG/Icon/person-circle.svg" style="margin-right: 10px; width: 20px; float: left;">Crear Usuario</li></a>
                <?php endif; ?>            
            </ul>
        </nav>
    </header>
    <main>
        <div class="title_dcgenenator">
            <h1>Agregar cintas al Inventario</h1>
            <div class="advert">
                <em><p>INGRESAR TODOS LOS VALORES EN LOS CAMPOS QUE SE PRESENTAN ACONTINUACION</p></em><hr>
            </div>
        </div>
        <div class="doc_info">
        <form action="/php/Add_cintas.php" method="POST" id="FrmCinta">
            <div class="input_container">
                <div class="form-group">
                    <label for="client_name">Nombre del Cliente:</label>
                    <input type="text" id="client_name" name="client_name" placeholder="Client" required>
                </div>
                <div class="form-group">
                    <label for="co">Contrato:</label>
                    <input type="text" placeholder="CO" id="co" class="co" name="co" required>
                </div>
                <div class="form-group">
                    <label for="sr">Ticket de Ingreso:</label>
                    <input type="text" placeholder="SR" id="sr" class="sr" name="sr" required>
                </div>
                <div class="form-group">
                    <label for="enc">Email Field Manager:</label>
                    <input type="text" placeholder="Field-Manager" id="enc" name="enc" required>
                </div>
            </div>
            <div class="input_container">
                <div class="form-group">
                    <label for="hrEsti">Hora de ingreso:</label>
                    <input type="time" id="hrEsti" name="hrEsti" required>
                </div>
                <div class="form-group">
                    <label for="FechaIO">Fecha de ingreso:</label>
                    <input type="date" id="FechaIO" name="FechaIO" required>
                </div>
                <div class="form-group">
                    <label for="ingr">Agregada por:</label>
                    <input type="text" id="ingr" name="ingr" placeholder="Operador" required>
                </div>
            </div>
            <hr>
            <div class="Info_cinta">
                <div class="input_container">
                    <div class="form-group">
                        <label for="TypeCinta">Tipo:</label>
                        <input type="text" class="TipoCint" id="TypeCinta" name="TypeCinta" placeholder="LTO" required>
                    </div>
                    <div class="form-group">
                        <label for="DesCin">Descripcion:</label>
                        <input type="text" id="DesCin" name="DesCin" placeholder="LTO - 1.5TB" required>
                    </div>
                    <div class="form-group">
                        <label for="CCinta">Codigo:</label>
                        <input type="text" id="CCinta" name="CCinta" placeholder="CODE0001" required>
                    </div>
                </div><br>
                <div class="AgreBtn">
                    <button type="submit" onclick="agregarCinta()">
                        <img src="/IMG/Icon/plus-lg.svg"> Agregar
                    </button>
                </div>
            </div>
        </form>
                <div class="tabla_Cont">
                    <div class="tabla_preview">
                        <table id="tablaCintas">
                            <tr>
                                <th>#</th>
                                <th>Cliente</th>
                                <th>Tipo</th>
                                <th>Descripcion</th>
                                <th>Codigo</th>
                            </tr>
                            <!-- Contenido de la tabla -->
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeOptions()">&times;</span>
                <p>Elige una opción:</p><hr>
                <a href="/Pages/IngresoDeMedios.php">Ingreso de Medios</a>
                <a href="/Pages/SalidaDeMedios.php">Salida de Medios</a>
            </div>
        </div>
        <footer>
            <div class="botones-container">
                <a href="#">
                <button id="addDatabaseButton">
                    <img style="height: 20px;" src="/IMG/Icon/database-add.svg">
                </button>
                </a>
            </div>
        </footer>
        <div id="inactivityModal" class="modal">
            <div class="modal-content">
                <p>En <span id="inactivityCountdown">25</span> segundos se cerrará la sesión.</p>
                <button id="continueSessionBtn">Continuar sesión</button>
            </div>
        </div>
    </body>
    </html>
