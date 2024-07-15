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
        } else {
            nuevoMensaje.textContent = 'Código disponible';
            nuevoMensaje.style.color = 'green';
        }
        codigoInput.parentNode.appendChild(nuevoMensaje);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

// Asignar el evento onclick al botón para validar el código
document.querySelector('button[onclick="ValidCode()"]').addEventListener('click', ValidCode);

// Función GenCode (ya proporcionada)
function GenCode() {
    let clientName = document.getElementById('client_name').value;
    let namePart = clientName.substring(0, 4).toUpperCase();

    let letters = '';
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for (let i = 0; i < 3; i++) {
        letters += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    let numbers = Math.floor(Math.random() * 999) + 1;
    numbers = String(numbers).padStart(3, '0');

    let generatedCode = `${namePart}_${letters}_${numbers}`;

    document.getElementById('CCintaInter').value = generatedCode;
}

// Asignar el evento onclick al botón para generar el código
document.querySelector('button[onclick="GenCode()"]').addEventListener('click', GenCode);
