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

  let transactionFormData = new FormData(form);
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
  newTypeCellRef.textContent = document.getElementById("UbiCin").value; // Aquí obtenemos el valor del select

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
});
