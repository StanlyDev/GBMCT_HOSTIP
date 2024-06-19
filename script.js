document.getElementById("createUserBtn").onclick = function() {
    document.getElementById("adminLoginModal").style.display = "block";
}

function closeAdminLoginModal() {
    document.getElementById("adminLoginModal").style.display = "none";
}

function closeCreateUserModal() {
    document.getElementById("createUserModal").style.display = "none";
}

function adminLogin() {
    var adminUsername = document.getElementById("adminUsername").value;
    var adminPassword = document.getElementById("adminPassword").value;

    // Simulación de verificación de credenciales de administrador
    if ((adminUsername === "admin" || adminUsername === "root") && adminPassword === "adminpassword") {
        document.getElementById("adminLoginModal").style.display = "none";
        document.getElementById("createUserModal").style.display = "block";
    } else {
        alert("Credenciales de administrador incorrectas");
    }
}

// Cerrar el modal cuando el usuario hace clic fuera de él
window.onclick = function(event) {
    if (event.target == document.getElementById("adminLoginModal")) {
        document.getElementById("adminLoginModal").style.display = "none";
    }
    if (event.target == document.getElementById("createUserModal")) {
        document.getElementById("createUserModal").style.display = "none";
    }
}
