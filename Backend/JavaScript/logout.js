// Función para redirigir al usuario al cerrar sesión después de cierto tiempo de inactividad
function iniciarTemporizador() {
    var tiempoLimite = 50 * 1000; // 50 segundos en milisegundos
    var avisoTiempo = 25 * 1000; // Tiempo antes de que aparezca la alerta (25 segundos de inactividad)
    var temporizador, temporizadorAviso;

    var modal = document.getElementById('inactivityModal');
    var countdownElement = document.getElementById('inactivityCountdown');
    var continueSessionBtn = document.getElementById('continueSessionBtn');

    // Función para redirigir al usuario a la página de cerrar sesión
    function redirigirLogout() {
        window.location.href = "/Backend/php/logout.php";
    }

    // Función para mostrar el aviso con cuenta regresiva
    function mostrarAviso() {
        modal.style.display = 'block';
        var contador = 25; // Tiempo para la cuenta regresiva en segundos
        countdownElement.textContent = contador;
        var intervalo = setInterval(function() {
            contador--;
            countdownElement.textContent = contador;
            if (contador <= 0) {
                clearInterval(intervalo);
                redirigirLogout();
            }
        }, 1000);

        continueSessionBtn.onclick = function() {
            clearInterval(intervalo);
            modal.style.display = 'none';
            reiniciarTemporizador();
        };
    }

    // Función para reiniciar los temporizadores solo cuando el modal no está visible
    function reiniciarTemporizador() {
        if (modal.style.display !== 'block') {
            clearTimeout(temporizador);
            clearTimeout(temporizadorAviso);
            temporizadorAviso = setTimeout(mostrarAviso, avisoTiempo);
            temporizador = setTimeout(redirigirLogout, tiempoLimite);
        }
    }

    // Iniciar los temporizadores al cargar la página
    reiniciarTemporizador();

    // Agregar event listeners para reiniciar el temporizador al detectar actividad del usuario
    document.addEventListener("mousemove", reiniciarTemporizador);
    document.addEventListener("keypress", reiniciarTemporizador);
    document.addEventListener("click", reiniciarTemporizador);
    document.addEventListener("scroll", reiniciarTemporizador);
}

// Iniciar el temporizador cuando la página se carga completamente
window.onload = function() {
    iniciarTemporizador();

    // Agregar evento de clic al botón de cerrar sesión
    document.getElementById('cerrarSesionBtn').addEventListener('click', function() {
        // Redirigir al usuario a la página de cierre de sesión
        window.location.href = "/Backend/php/logout.php";
    });
};

