function editarUsuario(userId) {
    // Obtener la fila de la tabla que corresponde al usuario seleccionado
    const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);

    // Obtener los elementos de la fila
    const nombreCell = userRow.querySelector('td:nth-child(1)');
    const correoCell = userRow.querySelector('td:nth-child(2)');
    const rolCell = userRow.querySelector('td:nth-child(3)');
    const actionCell = userRow.querySelector('td:nth-child(4)');

    // Obtener los valores originales de los campos
    const nombreOriginal = nombreCell.textContent.trim();
    const correoOriginal = correoCell.textContent.trim();
    const rolOriginal = rolCell.textContent.trim();

    // Convertir los elementos en inputs/editables
    nombreCell.innerHTML = `<input type="text" value="${nombreOriginal}" class="editable nombre">`;
    correoCell.innerHTML = `<input type="email" value="${correoOriginal}" class="editable correo">`;
    rolCell.innerHTML = `
        <select class="editable rol">
            <option value="Administrador"${rolOriginal === 'Administrador' ? ' selected' : ''}>Administrador</option>
            <option value="Operador"${rolOriginal === 'Operador' ? ' selected' : ''}>Operador</option>
            <option value="Root"${rolOriginal === 'Root' ? ' selected' : ''}>Root</option>
        </select>
    `;
    actionCell.innerHTML = `
        <button class="save" onclick="guardarCambiosUsuario(${userId})">Guardar</button>
        <button class="cancel" onclick="cancelarEdicion(${userId})">Cancelar</button>
    `;
}

// Función para guardar cambios en un usuario
function guardarCambiosUsuario(userId) {
    // Obtener los valores editados
    const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);
    const nombre = userRow.querySelector('.nombre input').value;
    const correo = userRow.querySelector('.correo input').value;
    const rol = userRow.querySelector('.rol select').value;

    // Aquí puedes enviar una solicitud AJAX para guardar los cambios
    console.log(`Guardando cambios para el usuario ${userId}: Nombre: ${nombre}, Correo: ${correo}, Rol: ${rol}`);
}

// Función para cancelar la edición
function cancelarEdicion(userId) {
    // Recargar la página para cancelar la edición
    location.reload();
}
