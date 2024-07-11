<?php
session_start();

// Verificar si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
if (!isset($_SESSION["id"])) {
    header("Location: /index.html");
    exit();
}

// Verificar si el usuario ha sido validado
/*if (!isset($_SESSION['validated']) || $_SESSION['validated'] !== true) {
    header("Location: /Pages/validate_code.php");
    exit();
}*/

// Obtener el rol del usuario desde la sesión
$usuario_rol = $_SESSION["role"] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Frontend/CSS/inventory.css">
    <link rel="shortcut icon" href="/Frontend/IMG/Icon/GBM-logo-1.ico">
    <script defer src="/Backend/JavaScript/script.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
    <script defer src="/Backend/JavaScript/TableInventoryJS.js"></script>
    <script defer src="/Backend/JavaScript/BuscadorClient.js"></script>
    <script defer src="/Backend/JavaScript/windowsDoc.js"></script>
    <script defer src="/Backend/JavaScript/HistoAlert.js"></script>
    <script defer src="/Backend/JavaScript/logout.js"></script>
    <script defer src="/Backend/JavaScript/view_DeIn.js"></script>
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
  <!--Fin Cabecera-->
  <main>
    <!--Inicio Main-->
    <div class="title_inven">
      <h1>Eliminar cinta del inventario</h1><br>
      <p style="color: red; margin-left: 50px;">Los cambios realizados en este apartados son irreversibles</p><hr>
    </div>
    <!--Informacion de cinta-->
    <div class="Info_Cinta">
      <div class="Buscador">
        <p>Cliente: </p>
        <div class="autocomplete">
          <input id="search-input" class="autocomplete-input" type="text" placeholder="Nombre del cliente">
          <p style="margin-left: 10px;">Codigo de Cliente: </p>
          <input id="search-codigo" class="autocomplete-input" type="text" placeholder="Codigo de Cinta">
          <p style="margin-left: 10px;">Codigo Interno: </p>
          <input id="search-codigo-inter" class="autocomplete-input" type="text" placeholder="Codigo de Cinta">
        </div>
      </div>
    </div>
    <!--Fin Informacion de cinta-->
    <div class="tabla_Cont">
      <!--Inicio tabla Inventario-->
      <div class="tabla_invent">
        <table>
          <thead>
            <tr>
                <th scope="row">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Tipo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Código de Cliente</th>
                <th scope="col">Código Interno DC</th>
                <th scope="col">Ubicacion</th>
                <th scope="col">Ticket</th>
                <th scope="col">Field Manager Email</th>
                <th scope="col">Hora de ingreso</th>
                <th scope="col">Fecha de ingreso</th>
                <th scope="col">Agregado por</th>
                <th scope="col">X</th> <!-- Nuevo encabezado para acciones -->
            </tr>
          </thead>        
          <tbody id="tablaBody">
            <!-- Aquí se agregarán las filas de la tabla -->
          </tbody>
        </table>
      </div>
    </div>
    <!--Fin Main-->
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