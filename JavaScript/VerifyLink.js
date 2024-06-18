document.addEventListener('DOMContentLoaded', function() {
    // Obtener el elemento del enlace de verificación
    const verifyLink = document.getElementById('verifyLink');

    // Agregar un event listener para el clic en el enlace
    verifyLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

        // Hacer la solicitud al servidor PHP para generar y guardar el código
        fetch('/php/php/generate_verify_code.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: ''
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al generar y guardar el código.');
            }
            // Redirigir al usuario a la página de verificación
            window.location.href = '/Pages/VerifyCode.php';
        })
        .catch(error => {
            console.error('Error:', error);
            // Manejar el error como sea necesario
            alert('Error al generar y guardar el código.');
        });
    });
});