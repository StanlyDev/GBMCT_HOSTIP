// JavaScript (script.js)
function imprimirValores() {
  // Obtener el formulario y sus elementos
  var formulario = document.getElementById("FrmCinta");
  var srValue = formulario.querySelector("#SR").value;
  var origenValue = formulario.querySelector("#Origen").value;
  var destinoValue = formulario.querySelector("#Destino").value;
  var hrEstiValue = formulario.querySelector("#hrEsti").value;
  var fechaIOValue = formulario.querySelector("#FechaIO").value;
  var soliXValue = formulario.querySelector("#SoliX").value;
  var nombre1Value = document.getElementById("Nombre1").value;
  var dni1Value = document.getElementById("DNI1").value;
  var nombre2Value = document.getElementById("Nombre2").value;
  var dni2Value = document.getElementById("DNI2").value;  

  // ... (obtener más valores según sea necesario)

  sessionStorage.setItem("nombre1", nombre1Value);
  sessionStorage.setItem("dni1", dni1Value);
  sessionStorage.setItem("nombre2", nombre2Value);
  sessionStorage.setItem("dni2", dni2Value);

  // Obtener los datos para compartir
  var datosParaCompartir = {
    cintas: obtenerDatosTablaCintas()
    // Puedes agregar más datos si es necesario
  };

  // Convertir los datos a una cadena JSON
  var datosCompartidosStr = JSON.stringify(datosParaCompartir);

  // Almacenar los datos compartidos en sessionStorage
  sessionStorage.setItem("datosCompartidos", datosCompartidosStr);

  // Abrir la nueva ventana (DocVison.html) y pasar los valores mediante parámetros de la URL
  var nuevaVentana = window.open('DocVisor.html' +
                                '?sr=' + encodeURIComponent(srValue) +
                                '&origen=' + encodeURIComponent(origenValue) +
                                '&destino=' + encodeURIComponent(destinoValue) +
                                '&hrEsti=' + encodeURIComponent(hrEstiValue) +
                                '&fechaIO=' + encodeURIComponent(fechaIOValue) +
                                '&soliX=' + encodeURIComponent(soliXValue),
                                '_blank');

}

function obtenerDatosTablaCintas() {
  var datos = [];
  var tablaCintas = document.getElementById("tablaCintas");

  for (var i = 1; i < tablaCintas.rows.length; i++) {
    var fila = tablaCintas.rows[i];
    var cinta = {
      // Asegúrate de que estas propiedades coincidan con las que esperas en imprimirValue.js
      numero: fila.cells[0].textContent,
      tipo: fila.cells[2].textContent,
      descripcion: fila.cells[3].textContent,
      codigo: fila.cells[4].textContent
      // Puedes agregar más propiedades si es necesario
    };
    datos.push(cinta);
  }

  return datos;
}

function toggleMenu() {
  var navbar = document.querySelector('.navbar');
  var overlay = document.querySelector('.overlay');

  if (navbar.style.display === 'block' || getComputedStyle(navbar).display === 'block') {
    navbar.style.animation = 'slideOut 0.5s ease-in';
    overlay.style.display = 'none';
    setTimeout(() => {
      navbar.style.display = 'none';
      navbar.style.animation = '';
    }, 500);
  } else {
    navbar.style.display = 'block';
    navbar.style.animation = 'slideIn 0.5s ease-out';
    overlay.style.display = 'block';
  }
}
/*Devoloped by Brandon Ventura*/