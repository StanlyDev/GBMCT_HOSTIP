document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('createUserForm').onsubmit = saveUser;
});

function saveUser(event) {
    event.preventDefault();

    var form = document.getElementById('createUserForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/php/save_user.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            if (xhr.status == 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    if (response.error) {
                        console.error("Error al guardar el usuario:", response.error);
                        alert("Error al guardar el usuario: " + response.error);
                    } else {
                        console.log("Usuario guardado exitosamente:", response.message);
                        alert("Usuario guardado exitosamente");
                        // Actualizar la lista de usuarios después de agregar uno nuevo
                        getUsers();
                    }
                } catch (e) {
                    console.error("Error al parsear la respuesta:", e);
                    alert("Error inesperado. Por favor, inténtelo de nuevo.");
                }
            } else {
                console.error("Error de solicitud:", xhr.status);
                alert("Error de solicitud: " + xhr.status);
            }
        }
    };
    xhr.send(formData);
}
