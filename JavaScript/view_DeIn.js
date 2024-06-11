document.addEventListener('DOMContentLoaded', fetchData);

async function fetchData() {
  try {
    const response = await fetch('/php/preview_invent.php');
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
        <td>${item.TickectSR}</td>
        <td>${item.FMDEmail}</td>
        <td>${item.HrAdd}</td>
        <td>${item.DateAdd}</td>
        <td>${item.OperatorName}</td>
        <td><button class="delete_cinta" style="color: red;">X</button></td> <!-- Botón de eliminar cinta -->
    `;
    tablaBody.appendChild(row);
});
}