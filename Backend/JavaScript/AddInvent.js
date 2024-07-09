const form = document.getElementById("FrmCinta");
let numeroSecuencial = 1;

function agregarCinta() {
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    let ccintaInput = document.getElementById("CCinta");
    let ccintainterInput = document.getElementById("CCintaInter");
    let ccintaValue = ccintaInput.value;
    let ccintainterValue = ccintainterInput.value;

    // Verificar si el código de cinta ya está en uso
    verificarCodigoCinta(ccintaValue).then(isDuplicate => {
        if (isDuplicate) {
            alert("El código de Cinta ya se encuentra en uso");
        } else {
            let transactionTableRef = document.getElementById("tablaCintas").getElementsByTagName('tbody')[0];
            let newTransactionRowRef = transactionTableRef.insertRow();

            let newTypeCellRef;

            // Insertar el número secuencial en la primera celda
            newTypeCellRef = newTransactionRowRef.insertCell(0);
            newTypeCellRef.textContent = numeroSecuencial;

            newTypeCellRef = newTransactionRowRef.insertCell(1);
            newTypeCellRef.textContent = document.getElementById("client_name").value;

            newTypeCellRef = newTransactionRowRef.insertCell(2);
            newTypeCellRef.textContent = document.getElementById("co").value;

            newTypeCellRef = newTransactionRowRef.insertCell(3);
            newTypeCellRef.textContent = ccintaValue;

            newTypeCellRef = newTransactionRowRef.insertCell(4);
            newTypeCellRef.textContent = ccintainterValue;

            newTypeCellRef = newTransactionRowRef.insertCell(5);
            newTypeCellRef.textContent = document.getElementById("TypeCinta").value;

            newTypeCellRef = newTransactionRowRef.insertCell(6);
            newTypeCellRef.textContent = document.getElementById("DesCin").value;

            newTypeCellRef = newTransactionRowRef.insertCell(7);
            newTypeCellRef.textContent = document.getElementById("sr").value;

            newTypeCellRef = newTransactionRowRef.insertCell(8);
            newTypeCellRef.textContent = document.getElementById("hrEsti").value;

            newTypeCellRef = newTransactionRowRef.insertCell(9);
            newTypeCellRef.textContent = document.getElementById("FechaIO").value;

            newTypeCellRef = newTransactionRowRef.insertCell(10);
            newTypeCellRef.textContent = document.getElementById("fdm").value;

            newTypeCellRef = newTransactionRowRef.insertCell(11);
            newTypeCellRef.textContent = document.getElementById("operator").value;

            // Agregar botón de eliminación
            let deleteButton = document.createElement("button");
            deleteButton.textContent = "X";
            deleteButton.className = "delete-row-btn";
            deleteButton.onclick = function() {
                if (confirm("¿Estás seguro de que deseas eliminar esta fila?")) {
                    eliminarFila(this);
                }
            };

            let deleteCellRef = newTransactionRowRef.insertCell(11);
            deleteCellRef.appendChild(deleteButton);
            deleteCellRef.classList.add('delete-row-btn-cell');

            numeroSecuencial++;

            // Enviar los datos a través de AJAX
            enviarDatos();

            // Limpiar campos después de agregar
            limpiarCampos();
        }
    }).catch(error => {
        console.error('Error al verificar el código de cinta:', error);
        alert('Error al verificar el código de cinta');
    });
}

function verificarCodigoCinta(codigo) {
    return fetch('/Backend/php/valide_code.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ codigo: codigo })
    })
    .then(response => response.json())
    .then(data => data.exists);
}

function eliminarFila(button) {
    let row = button.closest('tr');
    row.parentNode.removeChild(row);

    // Reiniciar el número secuencial
    numeroSecuencial = 1;

    // Actualizar el número secuencial en las filas restantes
    let table = document.getElementById("tablaCintas");
    let rows = table.rows;

    for (let i = 1; i < rows.length; i++) { // Comenzar desde 1 para omitir el encabezado
        let cell = rows[i].cells[0];
        cell.textContent = numeroSecuencial++;
    }
}

function enviarDatos() {
    const formData = new FormData(form);

    fetch('/Backend/php/add_inventory.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Cinta agregada exitosamente');
        } else {
            alert('Error al agregar la cinta');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al agregar la cinta');
    });
}

function limpiarCampos() {
    document.getElementById("TypeCinta").value = '';
    document.getElementById("DesCin").value = '';
    document.getElementById("CCinta").value = '';
    document.getElementById("CCintaInter").value = '';
}
