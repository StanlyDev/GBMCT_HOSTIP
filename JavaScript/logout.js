// Función para redirigir al usuario al cerrar sesión después de cierto tiempo de inactividad
function iniciarTemporizador() {
    // Definir el tiempo límite de inactividad en milisegundos (20 segundos)
    var tiempoLimite = 20 * 1000; // 20 segundos en milisegundos
    var avisoTiempo = 5 * 1000; // Tiempo antes de que aparezca la alerta (15 segundos de inactividad)
    var temporizador, temporizadorAviso;

    // Función para redirigir al usuario a la página de cerrar sesión
    function redirigirLogout() {
        window.location.href = "/php/logout.php";
    }

    // Función para mostrar el aviso con cuenta regresiva
    function mostrarAviso() {
        var contador = 5; // Tiempo para la cuenta regresiva en segundos
        var intervalo = setInterval(function() {
            if (contador > 0) {
                var continuar = confirm("En " + contador + " segundos se cerrará la sesión, de click en Aceptar para continuar en sesión.");
                if (continuar) {
                    reiniciarTemporizador();
                    clearInterval(intervalo);
                    return;
                }
                contador--;
            } else {
                clearInterval(intervalo);
                redirigirLogout();
            }
        }, 1000);
    }

    // Función para reiniciar los temporizadores
    function reiniciarTemporizador() {
        clearTimeout(temporizador);
        clearTimeout(temporizadorAviso);
        temporizadorAviso = setTimeout(mostrarAviso, avisoTiempo);
        temporizador = setTimeout(redirigirLogout, tiempoLimite);
    }

    // Reiniciar el temporizador al cargar la página y al detectar actividad del usuario
    reiniciarTemporizador();
    document.addEventListener("mousemove", reiniciarTemporizador);
    document.addEventListener("keypress", reiniciarTemporizador);
    document.addEventListener("click", reiniciarTemporizador);
    document.addEventListener("scroll", reiniciarTemporizador);
}

// Iniciar el temporizador cuando la página se carga completamente
window.onload = iniciarTemporizador;
