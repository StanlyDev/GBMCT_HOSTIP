const form = document.getElementById("FrmCinta");
let numeroSecuencial = 1;

function agregarCinta() {
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    let ccintaInput = document.getElementById("CCinta");
    let ccintaValue = ccintaInput.value;

    if (isDuplicateValue("tablaCintas", ccintaValue, 3)) {
        alert("El código de la cinta ya fue ingresado");
        return;
    }

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
    newTypeCellRef.textContent = document.getElementById("TypeCinta").value;

    newTypeCellRef = newTransactionRowRef.insertCell(5);
    newTypeCellRef.textContent = document.getElementById("DesCin").value;

    newTypeCellRef = newTransactionRowRef.insertCell(6);
    newTypeCellRef.textContent = document.getElementById("sr").value;

    newTypeCellRef = newTransactionRowRef.insertCell(7);
    newTypeCellRef.textContent = document.getElementById("hrEsti").value;

    newTypeCellRef = newTransactionRowRef.insertCell(8);
    newTypeCellRef.textContent = document.getElementById("FechaIO").value;

    newTypeCellRef = newTransactionRowRef.insertCell(9);
    newTypeCellRef.textContent = document.getElementById("fdm").value;

    newTypeCellRef = newTransactionRowRef.insertCell(10);
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

function isDuplicateValue(tableId, value, columnIndex) {
    let table = document.getElementById(tableId);
    let rows = table.rows;

    for (let i = 1; i < rows.length; i++) { // Comenzar desde 1 para omitir el encabezado
        let cell = rows[i].cells[columnIndex];
        if (cell.textContent === value) {
            return true;
        }
    }
    return false;
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

    fetch('/php/add_inventory.php', {
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
}
