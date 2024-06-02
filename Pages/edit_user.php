<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/create_user.css">
    <link rel="shortcut icon" href="/IMG/Icon/GBM-logo-1.ico">
    <title>GBM | CT</title>
</head>
<body>
    <div class="container">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre del usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody id="userTableBody">
                    <!-- Aquí se insertarán los datos de los usuarios -->
                    <tr>
                        <td>root</td>
                        <td>r@root.com</td>
                        <td>root</td>
                        <td><button onclick="editUser(1)">Editar</button></td>
                    </tr>
                    <!-- Otros usuarios -->
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function editUser(userId) {
            // Obtener la fila del usuario
            var userRow = document.querySelector("#userTableBody tr[data-user-id='" + userId + "']");
            // Obtener las celdas de la fila
            var cells = userRow.querySelectorAll("td");

            // Convertir las celdas en campos de entrada editables
            for (var i = 0; i < cells.length - 1; i++) { // Excluyendo el botón de editar
                var cell = cells[i];
                var cellText = cell.textContent;
                cell.innerHTML = "<input type='text' value='" + cellText + "'>";
            }

            // Cambiar el botón de editar por el botón de guardar
            var editButton = userRow.querySelector("button");
            editButton.textContent = "Guardar";
            editButton.setAttribute("onclick", "saveUser(" + userId + ")");
        }

        function saveUser(userId) {
            // Obtener la fila del usuario
            var userRow = document.querySelector("#userTableBody tr[data-user-id='" + userId + "']");
            // Obtener las celdas de la fila
            var cells = userRow.querySelectorAll("td");

            // Obtener los nuevos valores de los campos de entrada
            var newData = {};
            for (var i = 0; i < cells.length - 1; i++) { // Excluyendo el botón de editar
                var cell = cells[i];
                var inputValue = cell.querySelector("input").value;
                newData["field" + i] = inputValue;
            }

            // Aquí puedes realizar una solicitud AJAX para guardar los nuevos datos en la base de datos
            // Ejemplo de solicitud AJAX:
            // fetch("/php/save_user.php", {
            //     method: "POST",
            //     body: JSON.stringify(newData),
            //     headers: {
            //         "Content-Type": "application/json"
            //     }
            // }).then(response => {
            //     // Aquí puedes manejar la respuesta del servidor
            // });

            // Actualizar las celdas de la fila con los nuevos datos
            for (var i = 0; i < cells.length - 1; i++) { // Excluyendo el botón de editar
                var cell = cells[i];
                var inputValue = cell.querySelector("input").value;
                cell.textContent = inputValue;
            }

            // Cambiar el botón de guardar por el botón de editar
            var editButton = userRow.querySelector("button");
            editButton.textContent = "Editar";
            editButton.setAttribute("onclick", "editUser(" + userId + ")");
        }
    </script>
</body>
</html>
