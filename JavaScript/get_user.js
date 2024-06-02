// Función para obtener los usuarios de la base de datos y mostrarlos en la tabla
function getUsers() {
    // Realizar una solicitud AJAX para obtener los usuarios
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/Pages/create_user.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Actualizar el cuerpo de la tabla con los usuarios obtenidos
            document.getElementById("userTableBody").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
}

// Llamar a la función para obtener los usuarios cuando la página se carga
window.onload = getUsers;
