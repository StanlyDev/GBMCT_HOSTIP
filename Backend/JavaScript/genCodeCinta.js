function GenCode() {
    // Obtener el nombre del cliente del input correspondiente
    let clientName = document.getElementById('client_name').value;
    
    // Tomar las primeras 3 letras del nombre del cliente
    let namePart = clientName.substring(0, 3).toUpperCase();

    // Generar tres letras aleatorias
    let letters = '';
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for (let i = 0; i < 3; i++) {
        letters += characters.charAt(Math.floor(Math.random() * characters.length));
    }

    // Generar cuatro números al azar del 1 al 999
    let numbers = Math.floor(Math.random() * 999) + 1;
    // Formatear los números para que tengan al menos 3 dígitos
    numbers = String(numbers).padStart(3, '0');

    // Concatenar las partes para formar el código
    let generatedCode = `${namePart}_${letters}_${numbers}`;

    // Poner el código generado en el input correspondiente
    document.getElementById('CCinta').value = generatedCode;
}

// Asignar el evento onclick al botón para generar el código
document.querySelector('button[onclick="GenCode()"]').addEventListener('click', GenCode);