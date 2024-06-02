document.getElementById('createUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('create_user.php', { // Aquí se cambió a 'create_user.php'
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(usuario => {
        // Insertar el nuevo usuario en la tabla HTML
        const userTableBody = document.getElementById('userTableBody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td><input type="text" value="${usuario.nombre}" class="editable" disabled></td>
            <td><input type="email" value="${usuario.correo}" class="editable" disabled></td>
            <td>
                <select class="editable" disabled>
                    <option value="admin"${usuario.rol === 'admin' ? ' selected' : ''}>Administrador</option>
                    <option value="operator"${usuario.rol === 'operator' ? ' selected' : ''}>Operador</option>
                    <option value="root"${usuario.rol === 'root' ? ' selected' : ''}>Root</option>
                </select>
            </td>
            <td class="action-buttons flex">
                <button class="edit" onclick="editRow(this)">Editar</button>
                <button class="save hidden" onclick="saveRow(this)">Guardar</button>
                <button class="cancel hidden" onclick="cancelEdit(this)">Cancelar</button>
            </td>
        `;
        userTableBody.appendChild(newRow);
    })
    .catch(error => {
        console.error('Error al agregar usuario:', error);
    });

    // Resetear el formulario
    this.reset();
});

function editRow(button) {
    const row = button.closest('tr');
    const inputs = row.querySelectorAll('.editable');
    inputs.forEach(input => input.disabled = false);
    row.querySelector('.edit').classList.add('hidden');
    row.querySelector('.save').classList.remove('hidden');
    row.querySelector('.cancel').classList.remove('hidden');
}

function saveRow(button) {
    const row = button.closest('tr');
    const inputs = row.querySelectorAll('.editable');
    inputs.forEach(input => input.disabled = true);
    row.querySelector('.edit').classList.remove('hidden');
    row.querySelector('.save').classList.add('hidden');
    row.querySelector('.cancel').classList.add('hidden');

    // Aquí puedes hacer una solicitud AJAX a tu servidor para guardar los cambios si lo deseas
}

function cancelEdit(button) {
    const row = button.closest('tr');
    const inputs = row.querySelectorAll('.editable');
    inputs.forEach(input => {
        input.disabled = true;
        if (input.tagName === 'INPUT') {
            input.value = input.defaultValue;
        } else if (input.tagName === 'SELECT') {
            input.value = input.querySelector('option[selected]').value;
        }
    });
    row.querySelector('.edit').classList.remove('hidden');
    row.querySelector('.save').classList.add('hidden');
    row.querySelector('.cancel').classList.add('hidden');
}
