// Función para cargar usuarios en la tabla
function cargarUsuarios() {
    fetch('/php/get_user.php')
        .then(response => response.json())
        .then(usuarios => {
            const userTableBody = document.getElementById('userTableBody');
            userTableBody.innerHTML = ''; // Limpiar tabla antes de agregar usuarios
            usuarios.forEach(usuario => {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${usuario.username}</td>
                    <td>${usuario.email}</td>
                    <td>${usuario.role}</td>
                    <td><button onclick="editarUsuario(${usuario.id})">Editar</button></td>
                `;
                userTableBody.appendChild(newRow);
            });
        })
        .catch(error => console.error('Error al cargar usuarios:', error));
}

// Función para cargar usuarios al cargar la página
window.onload = cargarUsuarios;
