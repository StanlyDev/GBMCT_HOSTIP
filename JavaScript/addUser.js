// Función para editar usuario
function editarUsuario(userId) {
    // Obtener la fila de la tabla que corresponde al usuario seleccionado
    const userRow = document.querySelector(`tr[data-user-id="${userId}"]`);

    // Obtener los elementos de la fila
    const nombreCell = userRow.querySelector('.nombre');
    const correoCell = userRow.querySelector('.correo');
    const rolCell = userRow.querySelector('.rol');
    const actionCell = userRow.querySelector('.action-buttons');

    // Convertir los elementos en inputs/editables
    nombreCell.innerHTML = `<input type="text" value="${nombreCell.textContent}" class="editable">`;
    correoCell.innerHTML = `<input type="email" value="${correoCell.textContent}" class="editable">`;
    rolCell.innerHTML = `
        <select class="editable">
            <option value="admin"${rolCell.textContent === 'Administrador' ? ' selected' : ''}>Administrador</option>
            <option value="operator"${rolCell.textContent === 'Operador' ? ' selected' : ''}>Operador</option>
            <option value="root"${rolCell.textContent === 'Root' ? ' selected' : ''}>Root</option>
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
