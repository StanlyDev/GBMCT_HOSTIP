document.addEventListener("DOMContentLoaded", function () {
    // Obtener elementos del DOM
    var inputBusqueda = document.getElementById("search-input");
    var inputBusquedaCodigo = document.getElementById("search-codigo");
    var inputBusquedaCodigoInter = document.getElementById("search-codigo-inter");
    var checkboxes = document.querySelectorAll('.checkend_inv input[type="checkbox"]');
    var tabla = document.querySelector(".tabla_invent table");
    var filas = tabla.getElementsByTagName("tr");

    if (!inputBusqueda || !inputBusquedaCodigo || !inputBusquedaCodigoInter || !tabla) {
        console.error("No se encontraron todos los elementos necesarios en el DOM.");
        return;
    }

    // Función para asignar números secuenciales a las filas
    function asignarNumerosSecuenciales() {
        var numero = 1;
        for (var i = 1; i < filas.length; i++) {
            if (filas[i].style.display !== "none") {
                filas[i].getElementsByTagName("td")[0].innerText = numero++;
            }
        }
    }

    // Función para realizar la búsqueda y filtrar según los checkboxes
    function realizarBusqueda() {
        var busqueda = inputBusqueda.value.toLowerCase();
        var busquedaCodigo = inputBusquedaCodigo.value.toLowerCase();
        var busquedaCodigoInter = inputBusquedaCodigoInter.value.toLowerCase();

        for (var i = 1; i < filas.length; i++) {
            var fila = filas[i];
            var nombreCliente = fila.getElementsByTagName("td")[1].innerText.toLowerCase();
            var codigoCinta = fila.getElementsByTagName("td")[4].innerText.toLowerCase();
            var codigoCinInter = fila.getElementsByTagName("td")[5].innerText.toLowerCase();

            var mostrarFila = true;

            if ((busqueda && !nombreCliente.includes(busqueda)) ||
                (busquedaCodigo && !codigoCinta.includes(busquedaCodigo)) || 
                (busquedaCodigoInter && !codigoCinInter.includes(busquedaCodigoInter))) {
                mostrarFila = false;
            }

            fila.style.display = mostrarFila ? "" : "none";
        }

        // Asignar números secuenciales a las filas visibles después de la búsqueda
        asignarNumerosSecuenciales();
    }

    // Agregar eventos a los checkboxes
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", realizarBusqueda);
    });

    // Agregar evento de entrada al input de búsqueda
    inputBusqueda.addEventListener("input", realizarBusqueda);
    inputBusquedaCodigo.addEventListener("input", realizarBusqueda);
    inputBusquedaCodigoInter.addEventListener("input", realizarBusqueda);

    // Asignar automáticamente el número de cliente a las filas existentes
    asignarNumerosSecuenciales();
});
