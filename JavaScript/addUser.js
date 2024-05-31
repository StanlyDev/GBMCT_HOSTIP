document.getElementById('createUserForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;
    const password = document.getElementById('password').value;

    const userTableBody = document.getElementById('userTableBody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><input type="text" value="${name}" class="editable" disabled></td>
        <td><input type="email" value="${email}" class="editable" disabled></td>
        <td>
            <select class="editable" disabled>
                <option value="admin"${role === 'admin' ? ' selected' : ''}>Administrador</option>
                <option value="operator"${role === 'operator' ? ' selected' : ''}>Operador</option>
                <option value="root"${role === 'root' ? ' selected' : ''}>Root</option>
            </select>
        </td>
        <td class="action-buttons flex">
            <button class="edit" onclick="editRow(this)">Editar</button>
            <button class="save hidden" onclick="saveRow(this)">Guardar</button>
            <button class="cancel hidden" onclick="cancelEdit(this)">Cancelar</button>
        </td>
    `;
    userTableBody.appendChild(newRow);

    // Reset the form
    document.getElementById('createUserForm').reset();
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

    // Here you can make an AJAX request to your server to save the changes
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