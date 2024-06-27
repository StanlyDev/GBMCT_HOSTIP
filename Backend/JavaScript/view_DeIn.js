document.addEventListener('DOMContentLoaded', async function() {
  // Función para obtener y mostrar los datos en la tabla
  async function fetchData() {
      try {
          const response = await fetch('/Backend/php/preview_invent.php');
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
              <td>${item.id}</td>
              <td>${item.NombreCliente}</td>
              <td>${item.TipoCinta}</td>
              <td>${item.Descripcion}</td>
              <td>${item.CodigoCinta}</td>
              <td>${item.EnCintoteca ? 'Si' : 'No'}</td>
              <td>${item.TickectSR}</td>
              <td>${item.FDMEmail}</td>
              <td>${item.HrAdd}</td>
              <td>${item.DateAdd}</td>
              <td>${item.OperatorName}</td>
              <td><button class="delete_cinta" style="color: red;">X</button></td> <!-- Botón de eliminar cinta -->
          `;
          row.dataset.idCinta = item.id; // Establecer el ID de cinta en el atributo de datos de la fila
          tablaBody.appendChild(row);
      });

      const botonesEliminar = document.querySelectorAll('.delete_cinta');

      botonesEliminar.forEach(boton => {
          boton.addEventListener('click', function() {
              const confirmacion = confirm('¿Estás seguro de que deseas eliminar esta cinta del inventario?');

              if (confirmacion) {
                  const fila = boton.closest('tr');
                  const idCinta = fila.dataset.idCinta;
                  // Realizar solicitud de eliminación al servidor
                  eliminarCinta(idCinta);
              }
          });
      });
  }

  function eliminarCinta(idCinta) {
      fetch('/Backend/php/delete_cinta.php', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `id_cinta=${idCinta}`
      })
      .then(response => response.text())
      .then(data => {
          alert(data); // Muestra un mensaje de éxito o error después de la eliminación
          // Recargar la página o actualizar la tabla de inventario si es necesario
          fetchData(); // Actualizar los datos en la tabla después de la eliminación
      })
      .catch(error => {
          console.error('Error al eliminar la cinta:', error);
      });
  }

  // Obtener y mostrar los datos en la tabla cuando el DOM esté listo
  fetchData();
});
