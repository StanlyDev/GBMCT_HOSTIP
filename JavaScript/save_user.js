// Función para guardar un usuario en la base de datos
function saveUser(event) {
    // Evitar que se envíe el formulario de manera predeterminada
    event.preventDefault();

    // Obtener los valores del formulario
    var form = event.target;
    var name = form.querySelector("#name").value;
    var email = form.querySelector("#email").value;
    var role = form.querySelector("#role").value;
    var password = form.querySelector("#password").value;
    var userId = form.dataset.userId; // Obtener el ID del usuario del atributo de datos

    // Realizar una solicitud AJAX para guardar el usuario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/php/save_user.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                // Parsear la respuesta JSON
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Recargar la lista de usuarios después de guardar
                    getUsers();
                    // Limpiar el formulario después de guardar
                    form.reset();
                } else {
                    // Mostrar mensaje de error si no se pudo guardar el usuario
                    console.error("Error al guardar el usuario:", response.error);
                }
            } else {
                console.error("Error de solicitud:", xhr.status);
            }
        }
    };
    xhr.send("name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email) + "&role=" + encodeURIComponent(role) + "&password=" + encodeURIComponent(password) + "&userId=" + encodeURIComponent(userId));
}
