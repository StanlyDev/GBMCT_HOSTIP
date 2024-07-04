const form = document.getElementById("FrmCinta");
let numeroSecuencial = 1;

form.addEventListener("submit", function(event) {
    event.preventDefault();

    let ccintaInput = document.getElementById("CCinta");
    let ccintaValue = ccintaInput.value;

    if (isDuplicateValue("tablaCintas", ccintaValue, 4)) {
        alert("El código de la cinta ya fue ingresado");
        return;
    }

    let transactionTableRef = document.getElementById("tablaCintas");
    let newTransactionRowRef = transactionTableRef.insertRow(-1);

    let newTypeCellRef;

    // Insertar el número secuencial en la primera celda
    newTypeCellRef = newTransactionRowRef.insertCell(0);
    newTypeCellRef.textContent = numeroSecuencial;

    newTypeCellRef = newTransactionRowRef.insertCell(1);
    newTypeCellRef.textContent = document.getElementById("Origen").value;

    newTypeCellRef = newTransactionRowRef.insertCell(2);
    newTypeCellRef.textContent = document.getElementById("TypeCinta").value;

    newTypeCellRef = newTransactionRowRef.insertCell(3);
    newTypeCellRef.textContent = document.getElementById("DesCin").value;

    newTypeCellRef = newTransactionRowRef.insertCell(4);
    newTypeCellRef.textContent = ccintaValue;

    newTypeCellRef = newTransactionRowRef.insertCell(5);
    newTypeCellRef.textContent = document.getElementById("UbiCin").value;

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
    document.getElementById("UbiCin").value = "Cintoteca"; // Reseteamos el select al valor por defecto

    numeroSecuencial++;

    // Guardar los datos en sessionStorage
    let cintas = JSON.parse(sessionStorage.getItem("datosCompartidos")) || { cintas: [] };
    cintas.cintas.push({
        numero: numeroSecuencial,
        cliente: document.getElementById("Origen").value,
        tipo: document.getElementById("TypeCinta").value,
        descripcion: document.getElementById("DesCin").value,
        codigo: ccintaValue,
        ubicacion: document.getElementById("UbiCin").value
    });
    sessionStorage.setItem("datosCompartidos", JSON.stringify(cintas));
});

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

    // Actualizar sessionStorage
    let cintas = [];
    for (let i = 1; i < rows.length; i++) {
        let cells = rows[i].cells;
        cintas.push({
            numero: cells[0].textContent,
            cliente: cells[1].textContent,
            tipo: cells[2].textContent,
            descripcion: cells[3].textContent,
            codigo: cells[4].textContent,
            ubicacion: cells[5].textContent
        });
    }
    sessionStorage.setItem("datosCompartidos", JSON.stringify({ cintas: cintas }));
}
