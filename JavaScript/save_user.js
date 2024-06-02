function saveUser(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de manera convencional
    
    // Obtener los datos del formulario
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var role = document.getElementById("role").value;
    var password = document.getElementById("password").value;
    
    // Obtener el userId del atributo data-user-id de la fila del usuario actualmente editado
    var userId = document.querySelector("#userTableBody tr.editing").dataset.userId;

    // Realizar una solicitud AJAX para guardar los cambios
    fetch("/php/save_user.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            name: name,
            email: email,
            role: role,
            password: password,
            userId: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar la fila del usuario con los nuevos datos
            var userRow = document.querySelector("#userTableBody tr[data-user-id='" + userId + "']");
            var cells = userRow.querySelectorAll("td");
            cells[0].textContent = name;
            cells[1].textContent = email;
            cells[2].textContent = role;
            
            // Eliminar la clase de edición y restaurar el botón de editar
            userRow.classList.remove("editing");
            var editButton = userRow.querySelector("button");
            editButton.textContent = "Editar";
            editButton.disabled = false;
        } else {
            alert("Error al guardar los cambios.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
}
