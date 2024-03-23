document.addEventListener("DOMContentLoaded", function () {
    // Obtener elementos del DOM
    var inputBusqueda = document.getElementById("search-input");
    var inputBusquedaCodigo = document.getElementById("search-codigo");
    var checkboxes = document.querySelectorAll('.checkend_inv input[type="checkbox"]');
    var tabla = document.querySelector(".tabla_invent table");
    var filas = tabla.getElementsByTagName("tr");

    // Función para asignar números secuenciales a las filas
    function asignarNumerosSecuenciales() {
        for (var i = 1; i < filas.length; i++) {
            filas[i].getElementsByTagName("td")[0].innerText = i;
        }
    }

    // Función para realizar la búsqueda y filtrar según los checkboxes
    function realizarBusqueda() {
        var busqueda = inputBusqueda.value.toLowerCase();
        var busquedaCodigo = inputBusquedaCodigo.value.toLowerCase();
        var mostrarSi = checkboxes[0].checked;
        var mostrarNo = checkboxes[1].checked;

        for (var i = 1; i < filas.length; i++) {
            var fila = filas[i];
            var nombreCliente = fila.getElementsByTagName("td")[1].innerText.toLowerCase();
            var codigoCinta = fila.getElementsByTagName("td")[4].innerText.toLowerCase();
            var enCintoteca = fila.getElementsByTagName("td")[5].innerText.toLowerCase();

            var mostrarFila = true;

            if ((busqueda && !nombreCliente.includes(busqueda)) ||
                (busquedaCodigo && !codigoCinta.includes(busquedaCodigo))) {
                mostrarFila = false;
            }

            if ((mostrarSi && enCintoteca !== 'y') ||
                (mostrarNo && enCintoteca !== 'n')) {
                mostrarFila = false;
            }

            if (mostrarFila) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
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

    // Asignar automáticamente el número de cliente a las filas existentes
    asignarNumerosSecuenciales();

    // Realizar una solicitud al servidor para obtener los datos
    fetch('http://localhost:3000/data') // Cambia la URL según sea necesario
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('tablaBody');
            data.forEach((row, index) => {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                <td>${index + 1}</td>
                <td>${row.NombreCliente}</td>
                <td>${row.TipoCinta}</td>
                <td>${row.Descripcion}</td>
                <td>${row.CodigoCinta}</td>
                <td>${row.EnCintoteca}</td>
                `;
                tableBody.appendChild(newRow);
            });
        })
        .catch(error => console.error('Error al obtener los datos:', error));
});
