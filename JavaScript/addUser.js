// Función para editar usuario
function editarUsuario(userId) {
    // Buscar el usuario por su ID
    const usuario = obtenerUsuarioPorId(userId);

    // Completar el formulario de creación de usuario con los datos del usuario
    document.getElementById('name').value = usuario.nombre;
    document.getElementById('email').value = usuario.correo;
    document.getElementById('role').value = usuario.rol;

    // Cambiar el texto y el comportamiento del botón
    const createUserForm = document.getElementById('createUserForm');
    createUserForm.removeEventListener('submit', agregarUsuario);
    createUserForm.addEventListener('submit', function(event) {
        event.preventDefault();
        guardarCambiosUsuario(userId);
    });
    const submitButton = createUserForm.querySelector('button[type="submit"]');
    submitButton.textContent = 'Guardar Cambios';

    // Mostrar botón de cancelar
    document.getElementById('cancelButton').classList.remove('hidden');
}

// Función para guardar cambios en un usuario
function guardarCambiosUsuario(userId) {
    const formData = new FormData(document.getElementById('createUserForm'));

    fetch(`/php/edit_user.php?id=${userId}`, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al editar usuario');
        }
        return response.json();
    })
    .then(usuario => {
        // Aquí podrías actualizar la fila de la tabla con los nuevos datos del usuario
        console.log('Usuario editado:', usuario);
    })
    .catch(error => {
        console.error('Error al editar usuario:', error);
        alert('Error al editar usuario: ' + error.message);
    });

    // Resetear el formulario
    document.getElementById('createUserForm').reset();
}

// Función para cancelar la edición
function cancelarEdicion() {
    // Limpiar el formulario y restablecer el botón
    document.getElementById('createUserForm').reset();
    const submitButton = document.getElementById('createUserForm').querySelector('button[type="submit"]');
    submitButton.textContent = 'Crear Usuario';
    submitButton.removeEventListener('click', guardarCambiosUsuario);
    submitButton.addEventListener('click', agregarUsuario);

    // Ocultar botón de cancelar
    document.getElementById('cancelButton').classList.add('hidden');
}
