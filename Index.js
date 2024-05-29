function login() {
    // Obtener los valores de los campos de usuario y contraseña
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Validar que los campos no estén vacíos
    if (username === '' || password === '') {
        // Mostrar un mensaje de error si algún campo está vacío
        document.getElementById('message').innerText = 'Por favor, completa todos los campos.';
        return false; // Evitar el envío del formulario
    }

    // Si la validación pasa, permitir que el formulario se envíe
    return true;
}
