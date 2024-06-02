// Función para obtener los usuarios de la base de datos y mostrarlos en la tabla
function getUsers() {
    // Realizar una solicitud AJAX para obtener los usuarios
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/php/get_user.php", true); // Asegúrate de que la ruta sea correcta
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parsear la respuesta JSON
            var users = JSON.parse(xhr.responseText);

            // Obtener la tabla de usuarios
            var userTable = document.getElementById("userTableBody");

            // Limpiar la tabla antes de agregar usuarios
            userTable.innerHTML = "";

            // Iterar sobre los usuarios y agregarlos a la tabla
            for (var i = 0; i < users.length; i++) {
                var user = users[i];
                var row = "<tr>";
                row += "<td>" + user.username + "</td>";
                row += "<td>" + user.email + "</td>";
                row += "<td>" + user.role + "</td>";
                row += "<td><button onclick='editUser(" + user.id + ")'>Editar</button></td>";
                row += "</tr>";
                userTable.innerHTML += row;
            }
        }
    };
    xhr.send();
}

// Llamar a la función para obtener los usuarios cuando la página se carga
window.onload = getUsers;

// Función para editar un usuario
function editUser(userId) {
    // Redirigir a la página de edición de usuario con el ID del usuario como parámetro
    window.location.href = "/Pages/edit_user.php?id=" + userId;
}
