document.addEventListener('DOMContentLoaded', function () {
  var datosCompartidosStr = sessionStorage.getItem("datosCompartidos");
  var datosCompartidos = JSON.parse(datosCompartidosStr);

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

  // Verificar si los elementos existen antes de intentar actualizar su contenido
  var numeroHojaElement = document.getElementById("numeroHoja");
  var origenDocumentoElement = document.getElementById("origenDocumento");
  var destinoDocumentoElement = document.getElementById("destinoDocumento");
  var horaEstimadaElement = document.getElementById("horaEstimada");
  var nombreClienteElement = document.getElementById("nombreCliente");
  var solicitadoPorElement = document.getElementById("solicitadoPor");
  var numeroTicketElement = document.getElementById("numeroTicket");
  var deliveredByElement = document.getElementById("delivered_by");
  var receivedByElement = document.getElementById("received_by");

  if (numeroHojaElement && origenDocumentoElement && destinoDocumentoElement && horaEstimadaElement &&
      nombreClienteElement && solicitadoPorElement && numeroTicketElement && deliveredByElement && receivedByElement) {
      numeroHojaElement.textContent = numeroHojaValue;
      origenDocumentoElement.textContent = origenDocumentoValue;
      destinoDocumentoElement.textContent = destinoDocumentoValue;
      horaEstimadaElement.textContent = horaEstimadaValue;
      nombreClienteElement.textContent = nombreClienteValue;
      solicitadoPorElement.textContent = solicitadoPorValue;
      numeroTicketElement.textContent = numeroTicketValue;
      deliveredByElement.textContent = nombre1Value + " con DNI " + dni1Value;
      receivedByElement.textContent = nombre2Value + " con DNI " + dni2Value;

      var tablaDocVisor = document.querySelector(".Table_Cinta table");

      if (tablaDocVisor) {
          tablaDocVisor.innerHTML = "<tr><th>#</th><th>Cliente</th><th>Tipo</th><th>Descripcion</th><th>Codigo</th><th>Ubicacion</th></tr>";

          datosCompartidos.cintas.forEach(function (cinta, index) {
              var fila = tablaDocVisor.insertRow(-1);
              var propiedadesCinta = ['numero', 'cliente', 'tipo', 'descripcion', 'codigo', 'ubicacion'];

              propiedadesCinta.forEach(function (propiedad) {
                  var celda = fila.insertCell();
                  celda.textContent = cinta[propiedad];
              });
          });
      } else {
          console.error("La tabla de documentos no fue encontrada en el documento.");
      }
  } else {
      console.error("Uno o más elementos no fueron encontrados en el documento.");
  }
});

function getParameterByName(name) {
  var urlParams = new URLSearchParams(window.location.search);
  return urlParams.get(name);
}
