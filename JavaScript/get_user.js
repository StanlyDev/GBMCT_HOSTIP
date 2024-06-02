// Función para obtener los usuarios de la base de datos y mostrarlos en la tabla
function getUsers() {
    // Realizar una solicitud AJAX para obtener los usuarios
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/php/get_users.php", true); // Corregido el nombre del archivo PHP
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Parsear la respuesta JSON
            var users = JSON.parse(xhr.responseText);

            // Obtener la tabla de usuarios
            var userTable = document.getElementById("userTableBody");

            // Limpiar la tabla antes de agregar usuarios
            userTable.innerHTML = "";

            // Iterar sobre los usuarios y agregarlos a la tabla
            users.forEach(function(user) {
                var row = "<tr>";
                row += "<td>" + user.username + "</td>";
                row += "<td>" + user.email + "</td>";
                row += "<td>" + user.role + "</td>";
                row += "<td><button onclick='editUser(" + user.id + ")'>Editar</button></td>";
                row += "</tr>";
                userTable.innerHTML += row;
            });
        }
    };
    xhr.send();
}
