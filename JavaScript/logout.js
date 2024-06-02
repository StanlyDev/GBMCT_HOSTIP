// Función para redirigir al usuario al cerrar sesión después de cierto tiempo de inactividad
function iniciarTemporizador() {
    var tiempoLimite = 50 * 1000; // 20 segundos en milisegundos
    var avisoTiempo = 20 * 1000; // Tiempo antes de que aparezca la alerta (15 segundos de inactividad)
    var temporizador, temporizadorAviso;

    var modal = document.getElementById('inactivityModal');
    var countdownElement = document.getElementById('inactivityCountdown');
    var continueSessionBtn = document.getElementById('continueSessionBtn');

    // Función para redirigir al usuario a la página de cerrar sesión
    function redirigirLogout() {
        window.location.href = "/php/logout.php";
    }

    // Función para mostrar el aviso con cuenta regresiva
    function mostrarAviso() {
        modal.style.display = 'block';
        var contador = 5; // Tiempo para la cuenta regresiva en segundos
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

    // Función para reiniciar los temporizadores
    function reiniciarTemporizador() {
        clearTimeout(temporizador);
        clearTimeout(temporizadorAviso);
        modal.style.display = 'none';
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
