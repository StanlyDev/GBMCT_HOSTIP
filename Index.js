var usuario = {
    username: "operador",
    password: "Odc4321"
};

function login() {
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if (username === usuario.username && password === usuario.password) {
        window.location.href = "/Pages/HomePage.html";
    } else {
        document.getElementById("message").innerHTML = "Credenciales incorrectas. Intenta de nuevo.";
    }
}
/*Devoloped by Brandon Ventura*/