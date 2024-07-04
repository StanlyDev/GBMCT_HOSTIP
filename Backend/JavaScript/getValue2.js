// getValue2 (parte de script.js)
function imprimirValores2() {
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

  sessionStorage.setItem("nombre1", nombre1Value);
  sessionStorage.setItem("dni1", dni1Value);
  sessionStorage.setItem("nombre2", nombre2Value);
  sessionStorage.setItem("dni2", dni2Value);

  var datosParaCompartir = {
      cintas: obtenerDatosTablaCintas()
  };

  var datosCompartidosStr = JSON.stringify(datosParaCompartir);
  sessionStorage.setItem("datosCompartidos", datosCompartidosStr);

  var nuevaVentana = window.open('DocVisor2.html' +
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
          numero: fila.cells[0].textContent,
          cliente: fila.cells[1].textContent,
          tipo: fila.cells[2].textContent,
          descripcion: fila.cells[3].textContent,
          codigo: fila.cells[4].textContent,
          ubicacion: fila.cells[5].textContent
      };
      datos.push(cinta);
  }

  return datos;
}

/* Developed by Brandon Ventura */
