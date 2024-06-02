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
  <link rel="stylesheet" href="/CSS/inventory.css">
  <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
  <script defer src="/JavaScript/script.js"></script>
  <script defer src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
  <script defer src="/JavaScript/TableInventoryJS.js"></script>
  <script defer src="/JavaScript/BuscadorClient.js"></script>
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
              <div class="home"><a href="/Pages/AddInvent.php"><script src="https://cdn.lordicon.com/lordicon.js"></script>
                <script src="https://cdn.lordicon.com/lordicon.js"></script>
                <lord-icon
                    src="https://cdn.lordicon.com/jgnvfzqg.json"
                    trigger="hover"
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
              <?php if ($usuario_rol === 'root' || $usuario_rol === 'admin'): ?>
                <a href="/Pages/create_user.php"><li><img src="/IMG/Icon/person-circle.svg" style="margin-right: 10px; width: 20px; float: left;">Crear Usuario</li></a>
                <?php endif; ?>          
              </ul>
      </nav>
      <!--Fin Menu-->
  </header>
  <!--Fin Cabecera-->
  <main>
    <!--Inicio Main-->
    <div class="title_inven">
      <h1> Inventario en Cintoteca</h1><hr>
    </div>
    <!--Informacion de cinta-->
    <div class="Info_Cinta">
      <div class="Buscador">
        <p>Cliente: </p>
        <div class="autocomplete">
          <input id="search-input" class="autocomplete-input" type="text" placeholder="Nombre del cliente">
          <p style="margin-left: 10px;">Codigo: </p>
          <input id="search-codigo" class="autocomplete-input" type="text" placeholder="Codigo de Cinta">
        </div>
      </div>
      <div class="checkend_inv">
        <label for="">En Cintoteca: </label>
        <input type="checkbox" id="check"><label for="check">Si</label>
        <input type="checkbox" id="check1"><label for="check1">No</label>
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
                <th scope="col">Código</th>
                <th scope="col">En Cintoteca Y/N</th>
            </tr>
        </thead>        
          <tbody id="tablaBody">
            
          </tbody>
        </table>
      </div>
    </div>
    <!--Fin Main-->
  </main><br>
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
      <button onclick="descargarExcel()">
        <img style="height: 25px; margin-right: 5px;" src="/IMG/Icon/file-earmark-excel.svg"><p>Descargar Excel</p>
      </button>
    </div>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', fetchData);

    async function fetchData() {
      try {
        const response = await fetch('/php/fetch_data.php');
        const data = await response.json();
        displayData(data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    }

    function displayData(data) {
      const tablaBody = document.getElementById('tablaBody');
      tablaBody.innerHTML = '';

      data.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${index + 1}</td>
          <td>${item.NombreCliente}</td>
          <td>${item.TipoCinta}</td>
          <td>${item.Descripcion}</td>
          <td>${item.CodigoCinta}</td>
          <td>${item.EnCintoteca ? 'Si' : 'No'}</td>
        `;
        tablaBody.appendChild(row);
      });
    }
  </script>
  <div id="inactivityModal" class="modal">
    <div class="modal-content">
        <p>En <span id="inactivityCountdown">5</span> segundos se cerrará la sesión.</p>
        <button id="continueSessionBtn">Continuar sesión</button>
    </div>
</div>    
</body>
</html>
