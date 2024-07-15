document.addEventListener("DOMContentLoaded", function() {
    const validarBtn = document.querySelector('button[onclick="ValidCode()"]');
    if (validarBtn) {
        validarBtn.addEventListener('click', function(event) {
            event.preventDefault();
            ValidCode();
        });
    }
});

function ValidCode() {
    const codigoInput = document.getElementById('CCinta');
    const codigo = codigoInput.value;

    // Limpiar mensaje previo
    const mensaje = document.getElementById('codigo-mensaje');
    if (mensaje) {
        mensaje.remove();
    }

    fetch('/Backend/php/valide_code.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ CdClient: codigo })
    })
    .then(response => response.json())
    .then(data => {
        const nuevoMensaje = document.createElement('p');
        nuevoMensaje.id = 'codigo-mensaje';
        if (data.exists) {
            nuevoMensaje.textContent = 'Código existente';
            nuevoMensaje.style.color = 'red';

            // Código está en uso, deshabilitar el botón de agregar
            disableAgregarButton(true);
        } else {
            nuevoMensaje.textContent = 'Código disponible';
            nuevoMensaje.style.color = 'green';

            // Código disponible, habilitar el botón de agregar
            disableAgregarButton(false);
        }
        codigoInput.parentNode.appendChild(nuevoMensaje);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function disableAgregarButton(disable) {
    const agregarBtn = document.getElementById('btnAgregar');
    if (agregarBtn) {
        agregarBtn.disabled = disable;
    }
}
