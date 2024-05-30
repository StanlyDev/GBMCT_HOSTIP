<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/DocGenerator.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/JavaScript/getValue.js"></script>
    <script defer src="/JavaScript/agregarCinta1.js"></script>
    <script defer src="/JavaScript/windowsDoc.js"></script>
    <script defer src="/JavaScript/sharedData.js"></script>
    <script defer src="/JavaScript/HistoAlert.js"></script>
    <script defer src="/JavaScript/firmas.js"></script>
    <title>GBM | CT</title>
</head>
<body>
    <div class="overlay"></div>
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
        <nav class="navbar">
            <button class="close-btn" onclick="toggleMenu()">✕</button><br><br>
            <ul>
                <a href="/Pages/inventory.php"><li><img src="/IMG/Icon/box2-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Inventario en Cintoteca</li></a>
                <a href="#" class="histo" onclick="histoAlert()"><li><img src="/IMG/Icon/arrow-counterclockwise.svg" style="margin-right: 10px; width: 20px; float: left;">Historial I/O</li></a>
                <a href="#" class="generate-doc" onclick="showOptions()"><li><img src="/IMG/Icon/file-earmark-text-fill.svg" style="margin-right: 10px; width: 20px; float: left;">Generar Documento</li></a>
            </ul>
        </nav>
    </header>
    <main>
        <div class="title_dcgenenator">
            <h1>Ingreso de Medios</h1>
            <hr>
        </div>
        <div class="doc_info">
            <form action="" id="FrmCinta">
                <div class="input_container_1">
                    <div class="SR">
                        <label for="SR">Ticket (SR):</label>
                        <input type="text" id="SR" name="SR">
                    </div>
                    <div class="Ori">
                        <label for="Origen">Origen:</label>
                        <input type="text" placeholder="Nombre del Cliente" id="Origen" class="inp" name="Origen">
                    </div>
                    <div class="Dest">
                        <label for="Destino">Destino:</label>
                        <input type="text" placeholder="GBM" id="Destino" name="Destino">
                    </div>
                </div>
                <div class="input_container_2">
                    <div class="HRest">
                        <label for="hrEsti">Hora estimada:</label>
                        <input type="time" id="hrEsti" name="hrEsti">
                    </div>
                    <div class="FechaS">
                        <label for="FechaIO">Fecha:</label>
                        <input type="date" id="FechaIO" name="FechaIO">
                    </div>
                    <div class="SolX">
                        <label for="SoliX">Solicitado por:</label>
                        <input type="text" id="SoliX" name="SoliX">
                    </div>
                </div>
                <hr>
                <div class="Info_cinta">
                    <div class="input_container_3">
                        <div class="TCinta">
                            <label for="TypeCinta">Tipo:</label>
                            <input type="text" class="TipoCint" id="TypeCinta" name="TypeCinta">
                        </div>
                        <div class="Desc">
                            <label for="DesCin">Descripcion:</label>
                            <input type="text" id="DesCin" name="DesCin">
                        </div>
                        <div class="Code">
                            <label for="CCinta">Codigo:</label>
                            <input type="text" id="CCinta" name="CCinta">
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
                <div id="checkboxFirmas">
                  <label for="mostrarFirmas"><b>Agregar firma</b></label>
                  <input type="checkbox" id="mostrarFirmas">
              </div>
                <div id="firmaContainer1" class="oculto">
                <center><p style="font-size: 15px; color: red;"><em>En caso de no poder realizar la firma dejar solo Nombre y DNI (Opcion de firma en desarrollo)</em></p></center><br>
                  <center><h3>Entregado por:</h3></center>
                  <div class="input_container_4">
                      <div class="TCinta">
                          <label for="Nombre1">Nombre:</label>
                          <input type="text" class="TipoCint" id="Nombre1" name="Nombre1">
                      </div>
                      <div class="Desc">
                          <label for="DNI1">DNI:</label>
                          <input type="text" id="DNI1" name="DNI1">
                      </div>
                  </div>
                  <canvas id="lienzoFirma1" width="300" height="150"></canvas>
                  <br>
                  <center><button onclick="borrarFirma('lienzoFirma1')">Borrar Firma</button></center>
              </div><br>
              <div id="firmaContainer2" class="oculto">
                  <center><h3>Recibido por:</h3></center>
                  <div class="input_container_4">
                      <div class="TCinta">
                          <label for="Nombre2">Nombre:</label>
                          <input type="text" class="TipoCint" id="Nombre2" name="Nombre2">
                      </div>
                      <div class="Desc">
                          <label for="DNI2">DNI:</label>
                          <input type="text" id="DNI2" name="DNI2">
                      </div>
                  </div>
                  <canvas id="lienzoFirma2" width="300" height="150"></canvas>
                  <br>
                  <center><button onclick="borrarFirma('lienzoFirma2')">Borrar Firma</button></center>
              </div>
          </div>
        </div>
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
            <a href="/Pages/DocVisor.html" target="_blank">
                <button onclick="imprimirValores()">
                    <img src="/IMG/Icon/file-earmark-pdf-fill.svg">
                    <img src="/IMG/Icon/file-earmark-pdf.svg">Descargar PDF
                </button>                
            </a>
        </div>
    </footer>
</body>
<!--Devoloped by Brandon Ventura-->
</html>
