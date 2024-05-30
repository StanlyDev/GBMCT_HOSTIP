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
    <title>GBM | CT</title>
</head>
<body>
    <div class="overlay"></div>
    <!--Inicio Cabecera-->
    <header>
        <div class="menu-btn" onclick="toggleMenu()">☰</div>
        <div class="close_user"><a href="/index.html"><script src="https://cdn.lordicon.com/lordicon.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/eoacwhtz.json"
                trigger="hover"
                stroke="bold"
                colors="primary:#ffffff,secondary:#02092b,tertiary:#02092b,quaternary:#02092b,quinary:#02092b,senary:#02092b,septenary:#ffffff"
                style="width:30px;height:30px">
            </lord-icon></a></div>
        <div class="home"><a href="/Pages/HomePage.php"><script src="https://cdn.lordicon.com/lordicon.js"></script>
            <lord-icon
                src="https://cdn.lordicon.com/wmwqvixz.json"
                trigger="morph"
                state="morph-home-3"
                colors="primary:#ffffff"
                style="width:30px;height:30px">
            </lord-icon></a></div>
        <div class="logo"><img src="/IMG/Logos/Logo-blanco-sin-fondo.png"></div>
        <!--Inicio Menu-->
        <nav class="navbar">
            <button class="close-btn" onclick="toggleMenu()">✕</button><br><br>
            <ul>
                <a href="/Pages/inventory.php"><li><img src="/IMG/Icon/box2-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Inventario en Cintoteca</li></a>
                <a href="#" class="histo" onclick="histoAlert()"><li><img src="/IMG/Icon/arrow-counterclockwise.svg" style="margin-right: 10px; width: 20px; float: left;">Historial I/O</li></a>
                <a href="#" class="generate-doc" onclick="showOptions()"><li><img src="/IMG/Icon/file-earmark-text-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Generar Documento</li></a>
            </ul>
        </nav>
        <!--Fin Menu-->
    </header>
    <!--Fin Cabecera-->
    <main>
        <!--Inicio Main-->
        <div class="head-add">
            <h1>
                Agregar cintas al Inventario
            </h1><br>
            <div class="advert">
                <em><p>INGRESAR TODOS LOS VALORES EN LOS CAMPOS QUE SE PRESENTAN ACONTINUACION</p></em><hr>
            </div>
        </div>
        <div class="add_info">
            <form action="" id="FrmCinta">
                <div class="input_container_1">
                    <div class="client_name">
                        <label for="client_name">Nombre del Cliente:</label>
                        <input type="text" id="client_name" name="client_name" placeholder="Client" required>
                    </div>
                    <div class="co">
                        <label for="co">Contrato:</label>
                        <input type="text" placeholder="CO" id="co" class="co" name="co" required>
                    </div>
                    <div class="enc">
                        <label for="enc">Field-Manager:</label>
                        <input type="text" placeholder="Field-Manager" id="enc" name="enc" required>
                    </div>
                </div>
                <div class="input_container_2">
                    <div class="HRest">
                        <label for="hrEsti">Hora de ingreso:</label>
                        <input type="time" id="hrEsti" name="hrEsti" required>
                    </div>
                    <div class="FechaS">
                        <label for="FechaIO">Fecha de ingreso:</label>
                        <input type="date" id="FechaIO" name="FechaIO" required>
                    </div>
                    <div class="ingr">
                        <label for="ingr">Agregada por:</label>
                        <input type="text" id="ingr" name="ingr" placeholder="Operador" required>
                    </div>
                </div>
                <hr>
                <div class="Info_cinta">
                    <div class="input_container_3">
                        <div class="TCinta">
                            <label for="TypeCinta">Tipo:</label>
                            <input type="text" class="TipoCint" id="TypeCinta" name="TypeCinta" placeholder="LTO" required>
                        </div>
                        <div class="Desc">
                            <label for="DesCin">Descripcion:</label>
                            <input type="text" id="DesCin" name="DesCin" placeholder="LTO - 1.5TB" required>
                        </div>
                        <div class="Code">
                            <label for="CCinta">Codigo:</label>
                            <input type="text" id="CCinta" name="CCinta" placeholder="CODE0001" required>
                        </div>
                    </div><br>
                    <div class="AgreBtn">
                        <button style="margin-right: 20px;" type="submit" onclick="agregarCinta()">
                            <img src="/IMG/Icon/plus-lg.svg"> Agregar
                        </button>
                    </div>
                </div>
            </form>
            <div class="List_Preview">
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
                            <!-- ... Contenido de la tabla ... -->
                        </table>
                    </div>
            </div><br>
          </div>
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
    <footer>
        <div class="botones-container">
            <a href="#">
                <button onclick="">
                    <img src="/IMG/Icon/database-add.svg">
                    <img src="/IMG/Icon/database-fill-add.svg">
                </button>                
            </a>
        </div>
    </footer>
</body>
<!--Devoloped by Brandon Ventura-->
</html>