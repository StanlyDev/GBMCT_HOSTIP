const form = document.getElementById("FrmCinta");
let numeroSecuencial = 1;

function agregarCinta() {
    let ccintaInput = document.getElementById("CCinta");
    let ccintaValue = ccintaInput.value;

    if (isDuplicateValue("tablaCintas", ccintaValue, 4)) {
        alert("El código de la cinta ya fue ingresado");
        return;
    }

    let transactionFormData = new FormData(form);
    let transactionTableRef = document.getElementById("tablaCintas");
    let newTransactionRowRef = transactionTableRef.insertRow(-1);

    let newTypeCellRef;

    // Insertar el número secuencial en la primera celda
    newTypeCellRef = newTransactionRowRef.insertCell(0);
    newTypeCellRef.textContent = numeroSecuencial;

    newTypeCellRef = newTransactionRowRef.insertCell(1);
    newTypeCellRef.textContent = document.getElementById("client_name").value;

    newTypeCellRef = newTransactionRowRef.insertCell(2);
    newTypeCellRef.textContent = document.getElementById("TypeCinta").value;

    newTypeCellRef = newTransactionRowRef.insertCell(3);
    newTypeCellRef.textContent = document.getElementById("DesCin").value;

    newTypeCellRef = newTransactionRowRef.insertCell(4);
    newTypeCellRef.textContent = ccintaValue;

    newTypeCellRef = newTransactionRowRef.insertCell(5);
    newTypeCellRef.textContent = document.getElementById("sr").value;

    newTypeCellRef = newTransactionRowRef.insertCell(6);
    newTypeCellRef.textContent = document.getElementById("enc").value;

    newTypeCellRef = newTransactionRowRef.insertCell(7);
    newTypeCellRef.textContent = document.getElementById("hrEsti").value;

    newTypeCellRef = newTransactionRowRef.insertCell(8);
    newTypeCellRef.textContent = document.getElementById("FechaIO").value;

    newTypeCellRef = newTransactionRowRef.insertCell(9);
    newTypeCellRef.textContent = document.getElementById("ingr").value;

    // Agregar botón de eliminación
    let deleteButton = document.createElement("button");
    deleteButton.textContent = "X";
    deleteButton.className = "delete-row-btn";
    deleteButton.onclick = function() {
        eliminarFila(this);
    };

    let deleteCellRef = newTransactionRowRef.insertCell(-1);
    deleteCellRef.appendChild(deleteButton);
    deleteCellRef.classList.add('delete-row-btn-cell'); // Agregar la clase a la celda    

    // Limpiar campos del formulario
    document.getElementById("TypeCinta").value = "";
    document.getElementById("DesCin").value = "";
    document.getElementById("CCinta").value = "";

    numeroSecuencial++;
}

function isDuplicateValue(tableId, value, columnIndex) {
    let table = document.getElementById(tableId);
    let rows = table.rows;

    for (let i = 0; i < rows.length; i++) {
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

    for (let i = 1; i < rows.length; i++) {
        let cell = rows[i].cells[0];
        cell.textContent = numeroSecuencial++;
    }
}

function agregarCintasAlInventario() {
    let table = document.getElementById("tablaCintas");
    let rows = table.rows;
    let cintas = [];

    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].cells;
        let cinta = {
            client_name: cells[1].textContent,
            co: cells[2].textContent,
            sr: cells[5].textContent,
            enc: cells[6].textContent,
            hrEsti: cells[7].textContent,
            FechaIO: cells[8].textContent,
            ingr: cells[9].textContent,
            TypeCinta: cells[2].textContent,
            DesCin: cells[3].textContent,
            CCinta: cells[4].textContent
        };
        cintas.push(cinta);
    }

    fetch('/php/add_inventory.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(cintas)
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra un mensaje de éxito o error
        // Luego puedes recargar la página o hacer lo que necesites
    })
    .catch(error => {
        console.error('Error al agregar cintas al inventario:', error);
    });
}
