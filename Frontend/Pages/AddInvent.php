<?php
session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}
// Obtener el rol del usuario desde la sesión
$usuario_rol = $_SESSION["role"] ?? '';
$email = $_SESSION["email"] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Frontend/CSS/AddInvent.css">
    <link rel="shortcut icon" href="/Frontend/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/Backend/JavaScript/AddInvent.js"></script>
    <script defer src="/Backend/JavaScript/windowsDoc.js"></script>
    <script defer src="/Backend/JavaScript/HistoAlert.js"></script>
    <script defer src="/Backend/JavaScript/logout.js"></script>
    <script defer src="/Backend/JavaScript/script.js"></script>
    <script defer src="/Backend/JavaScript/genCodeCinta.js"></script>
    <script defer src="/Backend/JavaScript/ValidCode.js"></script>
    <title>GBM | CT</title>
</head>
<body>
    <header>
        <div class="menu-btn" onclick="toggleMenu()">☰</div>
        <div class="logo"><img src="/Frontend/IMG/Logos/Logo-blanco-sin-fondo.png" alt="GBM Logo"></div>
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
                    </lord-icon>
                </a>
            </div>
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
        </div>
        <nav class="navbar">
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
    </header>
    <main>
        <div class="title_dcgenenator">
            <h1>Agregar cintas al Inventario</h1>
            <div class="advert">
                <em><p>INGRESAR TODOS LOS VALORES EN LOS CAMPOS QUE SE PRESENTAN ACONTINUACION</p></em><hr>
            </div>
        </div>
        <div class="doc_info">
            <form id="FrmCinta">
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
                        <label for="enc">Email Field Manager Email:</label>
                        <input type="email" placeholder="Field-Manager" id="fdm" name="enc" required>
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
                        <input type="text" id="operator" name="ingr" value="<?php echo htmlspecialchars($email); ?>" readonly>
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
                            <label for="CCinta">Código de cliente:</label>
                            <input type="text" id="CCinta" name="CCinta" placeholder="CODE0001" required>
                            <button type="button" onclick="ValidCode()">Validar Código</button>
                        </div>
                        <div class="form-group">
                            <label for="CCintaInter">Codigo interno:</label>
                            <input type="text" id="CCintaInter" name="CCintaInter" placeholder="CODEGEN_V1" required readonly>
                            <button type="button" onclick="GenCode()">Generar Codigo</button>
                        </div>
                        <div class="form-group">
                            <label for="UbiCint">Ubicacion:</label>
                            <select name="UbiCint" id="UbiCint" required>
                                <option value=""></option>
                                <option value="Libreria">Libreria</option>
                                <option value="Cintoteca">Cintoteca</option>
                            </select>
                        </div>
                    </div><br>
                    <div class="AgreBtn">
                    <button type="button" id="btnAgregar" onclick="agregarCinta()">Agregar Cinta</button>
                            <img src="/Frontend/IMG/Icon/plus-lg.svg" alt="Agregar"> Agregar
                        </button>
                    </div>
                </div>
            </form>
            <div class="tabla_Cont">
                <div class="tabla_preview">
                    <table id="tablaCintas">
                        <thead>
                            <tr>
                            <th>#</th>
                                <th>Cliente</th>
                                <th>Contrato</th>
                                <th>Codigo Cliente</th>
                                <th>Codigo Interno DC</th>
                                <th>Tipo</th>
                                <th>Descripcion</th>
                                <th>Ubicacion</th>
                                <th>Ticket</th>
                                <th>Hora de ingreso</th>
                                <th>Fecha de ingreso</th>
                                <th>Field Manager Email</th>
                                <th>Agregado por</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
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

