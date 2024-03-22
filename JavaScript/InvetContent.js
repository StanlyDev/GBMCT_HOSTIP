// Hacer una solicitud AJAX para obtener los datos del inventario
fetch('/datosInventario')
.then(response => response.json())
.then(data => {
    // Obtener la tabla
    const tabla = document.getElementById('tablaBody');
    
    // Limpiar la tabla
    tabla.innerHTML = '';

    // Iterar sobre los datos y agregar filas a la tabla
    data.forEach((fila, index) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <th scope="row">${index + 1}</th>
            <td>${fila.nombre}</td>
            <td>${fila.tipo}</td>
            <td>${fila.descripcion}</td>
            <td>${fila.codigo}</td>
            <td>${fila.en_cintoteca}</td>
        `;
        tabla.appendChild(tr);
    });
})
.catch(error => {
    console.error('Error al obtener los datos del inventario:', error);
});