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
    <link rel="stylesheet" href="/Frontend/CSS/DocGenerator.css">
    <link rel="shortcut icon" href="/Frontend/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/Backend/JavaScript/getValue.js"></script>
    <script defer src="/Backend/JavaScript/agregarCinta1.js"></script>
    <script defer src="/Backend/JavaScript/windowsDoc.js"></script>
    <script defer src="/Backend/JavaScript/sharedData.js"></script>
    <script defer src="/Backend/JavaScript/HistoAlert.js"></script>
    <script defer src="/Backend/JavaScript/firmas.js"></script>
    <script defer src="/Backend/JavaScript/logout.js"></script>
    <script defer src="/Backend/JavaScript/script.js"></script>
    <script defer src="/Backend/JavaScript/secure.js"></script>
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
            <div class="home"><a href="/Frontend/Pages/HomePage.php" title="Inicio"><script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/wmwqvixz.json"
                    trigger="morph"
                    state="morph-home-3"
                    colors="primary:#ffffff"
                    style="width:30px;height:30px">
                </lord-icon></a></div>
                <div class="close_user">
                <a href="/Backend/php/logout.php" title="Cerrar Sesion">
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
            <button class="close-btn" onclick="toggleMenu()">✕</button>
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
    <main>
        <div class="title_dcgenenator">
            <h1>Ingreso de Medios</h1>
            <hr>
        </div>
        <div class="doc_info">
            <form action="" id="FrmCinta">
                <div class="input_container">
                    <div class="form-group">
                        <label for="SR">Ticket (SR):</label>
                        <input type="text" id="SR" name="SR">
                    </div>
                    <div class="form-group">
                        <label for="Origen">Origen:</label>
                        <input type="text" placeholder="Nombre del Cliente" id="Origen" name="Origen">
                    </div>
                    <div class="form-group">
                        <label for="Destino">Destino:</label>
                        <input type="text" placeholder="GBM" id="Destino" name="Destino">
                    </div>
                </div>
                <div class="input_container">
                    <div class="form-group">
                        <label for="hrEsti">Hora estimada:</label>
                        <input type="time" id="hrEsti" name="hrEsti">
                    </div>
                    <div class="form-group">
                        <label for="FechaIO">Fecha:</label>
                        <input type="date" id="FechaIO" name="FechaIO">
                    </div>
                    <div class="form-group">
                        <label for="SoliX">Solicitado por:</label>
                        <input type="text" id="SoliX" name="SoliX">
                    </div>
                </div>
                <hr>
                <div class="Info_cinta">
                    <div class="input_container">
                        <div class="form-group">
                            <label for="TypeCinta">Tipo:</label>
                            <input type="text" id="TypeCinta" name="TypeCinta">
                        </div>
                        <div class="form-group">
                            <label for="DesCin">Descripcion:</label>
                            <input type="text" id="DesCin" name="DesCin">
                        </div>
                        <div class="form-group">
                            <label for="CCinta">Codigo:</label>
                            <input type="text" id="CCinta" name="CCinta">
                        </div>
                        <div class="form-group">
                            <label for="UbiCin">Ubicacion:</label>
                            <select name="UbiCin" id="UbiCin">
                                <option value=""></option>
                                <option value="Cintoteca">Cintoteca</option>
                                <option value="Libreria">Libreria</option>
                            </select>
                        </div>
                    </div>
                    <div class="AgreBtn">
                        <button type="submit" onclick="agregarCinta()">
                            <img src="/Frontend/IMG/Icon/plus-lg.svg"> Agregar
                        </button>
                    </div>
                </div>
            </form>
            <div class="List_Preview">
                <div class="tabla_Cont">
                    <table id="tablaCintas">
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
                            <!-- Las filas se agregarán dinámicamente aquí -->
                        </tbody>
                    </table>
                </div>
            </div>            
                <div id="checkboxFirmas">
                    <label for="mostrarFirmas"><b>Agregar firma</b></label>
                    <input type="checkbox" id="mostrarFirmas">
                </div>
                <div id="firmaContainer1" class="oculto">
                    <center><p style="font-size: 15px; color: red;"><em>En caso de no poder realizar la firma dejar solo Nombre y DNI (Opcion de firma en desarrollo)</em></p></center>
                    <h3>Entregado por:</h3>
                    <div class="input_container">
                        <div class="form-group">
                            <label for="Nombre1">Nombre:</label>
                            <input type="text" id="Nombre1" name="Nombre1">
                        </div>
                        <div class="form-group">
                            <label for="DNI1">DNI:</label>
                            <input type="text" id="DNI1" name="DNI1">
                        </div>
                    </div>
                    <!--<canvas id="lienzoFirma1" width="300" height="150"></canvas>
                    <center><button type="button" onclick="borrarFirma('lienzoFirma1')">Borrar Firma</button></center>-->
                </div>
                <div id="firmaContainer2" class="oculto">
                    <h3>Recibido por:</h3>
                    <div class="input_container">
                        <div class="form-group">
                            <label for="Nombre2">Nombre:</label>
                            <input type="text" id="Nombre2" name="Nombre2">
                        </div>
                        <div class="form-group">
                            <label for="DNI2">DNI:</label>
                            <input type="text" id="DNI2" name="DNI2">
                        </div>
                    </div>
                    <!--<canvas id="lienzoFirma2" width="300" height="150"></canvas>
                    <center><button type="button" onclick="borrarFirma('lienzoFirma2')">Borrar Firma</button></center>-->
                </div>
            </div>
        </div>
    </main>
    <!-- Ventana emergente -->
    <div id="myModal" class="modal">
        <div class="modal-content">
          <span class="close" onclick="closeOptions()">&times;</span>
          <p>Elige una opción:</p><hr>
          <a href="/Frontend/Pages/IngresoDeMedios.php">Ingreso de Medios</a>
          <a href="/Frontend/Pages/SalidaDeMedios.php">Salida de Medios</a>
        </div>
      </div>
    </div>
    <footer>
        <div class="botones-container">
            <a href="/Frontend/Pages/DocVisor.html" target="_blank">
                <button onclick="imprimirValores()">
                    <img src="/Frontend/IMG/Icon/file-earmark-pdf-fill.svg">
                    Descargar PDF
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
<!--Develop By Brandon Ventura | StanlyDev -->
</html>
