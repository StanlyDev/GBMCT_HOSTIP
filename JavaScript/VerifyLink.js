document.addEventListener('DOMContentLoaded', function() {
    // Obtener el elemento del enlace de verificación
    const verifyLink = document.getElementById('verifyLink');

    // Agregar un event listener para el clic en el enlace
    verifyLink.addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto del enlace

        // Hacer la solicitud al servidor PHP para generar y guardar el código
        fetch('/php/generate_verify_code.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                // Incluye cualquier dato que necesites enviar al servidor
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                console.error('Error:', data.error);
                alert('Error: ' + data.error);
            } else {
                console.log('Success:', data.message);
                alert('Success: ' + data.message);
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Error: ' + error);
        });        
    });
});