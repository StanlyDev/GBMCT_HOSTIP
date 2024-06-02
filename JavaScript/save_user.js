function saveUser(event) {
    event.preventDefault(); // Evitar el envío predeterminado del formulario

    // Obtener los datos del formulario
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var role = document.getElementById("role").value;
    var password = document.getElementById("password").value;

    // Realizar una solicitud AJAX para guardar el usuario
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/php/save_user.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Actualizar la tabla de usuarios después de guardar el usuario
            getUsers();
            // Limpiar los campos del formulario después de guardar el usuario
            document.getElementById("name").value = "";
            document.getElementById("email").value = "";
            document.getElementById("password").value = "";
        }
    };
    xhr.send("name=" + encodeURIComponent(name) + "&email=" + encodeURIComponent(email) + "&role=" + encodeURIComponent(role) + "&password=" + encodeURIComponent(password));
}