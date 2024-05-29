function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var messageElement = document.getElementById("message");

    fetch('/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            username: username,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            messageElement.style.color = 'green';
            messageElement.textContent = 'Inicio de sesión exitoso';
            setTimeout(() => {
                window.location.href = '/Pages/HomePage.html'; // Cambia a la ruta de tu página de destino
            }, 2000);
        } else {
            messageElement.style.color = 'red';
            messageElement.textContent = data.message;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        messageElement.style.color = 'red';
        messageElement.textContent = 'Hubo un error al iniciar sesión';
    });
}
