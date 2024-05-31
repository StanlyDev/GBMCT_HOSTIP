// Función para redirigir al usuario al cerrar sesión después de cierto tiempo de inactividad
function iniciarTemporizador() {
    // Definir el tiempo límite de inactividad en milisegundos (20 segundos)
    var tiempoLimite = 20 * 1000; // 20 segundos en milisegundos

    // Reiniciar el temporizador al detectar actividad del usuario
    var temporizador;
    function reiniciarTemporizador() {
        clearTimeout(temporizador);
        temporizador = setTimeout(function() {
            // Redirigir al usuario a la página de cerrar sesión
            window.location.href = "/logout.php";
        }, tiempoLimite);
    }

    // Reiniciar el temporizador al cargar la página y al detectar actividad del usuario
    reiniciarTemporizador();
    document.addEventListener("mousemove", reiniciarTemporizador);
    document.addEventListener("keypress", reiniciarTemporizador);
}

// Iniciar el temporizador cuando la página se carga completamente
window.onload = iniciarTemporizador;
