document.addEventListener('DOMContentLoaded', function () {
  // Obtener la cadena de datos compartidos desde sessionStorage
  var datosCompartidosStr = sessionStorage.getItem("datosCompartidos");

  // Convertir la cadena JSON a un objeto
  var datosCompartidos = JSON.parse(datosCompartidosStr);

  // Obtener los parámetros de los datos compartidos
  var numeroHojaValue = getParameterByName('numeroHoja');
  var origenDocumentoValue = getParameterByName('origen');
  var destinoDocumentoValue = getParameterByName('destino');
  var horaEstimadaValue = getParameterByName('hrEsti');
  var nombreClienteValue = getParameterByName('nombreCliente');
  var solicitadoPorValue = getParameterByName('soliX');
  var numeroTicketValue = getParameterByName('sr');
  var nombre1Value = sessionStorage.getItem("nombre1");
  var dni1Value = sessionStorage.getItem("dni1");
  var nombre2Value = sessionStorage.getItem("nombre2");
  var dni2Value = sessionStorage.getItem("dni2");

  // Actualizar los elementos en la página con los valores
  document.getElementById("numeroHoja").textContent = numeroHojaValue;
  document.getElementById("origenDocumento").textContent = origenDocumentoValue;
  document.getElementById("destinoDocumento").textContent = destinoDocumentoValue;
  document.getElementById("horaEstimada").textContent = horaEstimadaValue;
  document.getElementById("nombreCliente").textContent = nombreClienteValue;
  document.getElementById("solicitadoPor").textContent = solicitadoPorValue;
  document.getElementById("numeroTicket").textContent = numeroTicketValue;
  document.getElementById("delivered_by").textContent = nombre1Value + " con DNI " + dni1Value;
  document.getElementById("received_by").textContent = nombre2Value + " con DNI " + dni2Value;

  // Obtener la tabla en DocVisor.html
  var tablaDocVisor = document.querySelector(".Table_Cinta table");

  // Limpiar la tabla antes de agregar nuevos datos
  tablaDocVisor.innerHTML = "<tr><th>#</th><th>Tipo</th><th>Descripcion</th><th>Código</th><th>Ubicacion</th></tr>";

  // Iterar sobre los datos compartidos y agregar filas a la tabla
  datosCompartidos.cintas.forEach(function (cinta, index) {
    var fila = tablaDocVisor.insertRow(-1);

    // Asegurarse de que estas propiedades coincidan con las que usaste en script.js
    var propiedadesCinta = ['numero', 'tipo', 'descripcion', 'codigo', 'ubicacion'];

    propiedadesCinta.forEach(function (propiedad) {
      var celda = fila.insertCell();
      celda.textContent = cinta[propiedad];
    });
  });
});

function getParameterByName(name) {
  var urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}

/*Developed by Brandon Ventura*/
