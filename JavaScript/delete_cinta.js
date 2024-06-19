document.addEventListener('DOMContentLoaded', function() {
    const botonesEliminar = document.querySelectorAll('.delete_cinta');

    botonesEliminar.forEach(boton => {
        boton.addEventListener('click', function() {
            const confirmacion = confirm('¿Estás seguro de que deseas eliminar esta cinta del inventario?');

            if (confirmacion) {
                const fila = boton.closest('tr');
                const idCinta = fila.dataset.idCinta;
                // Realizar solicitud de eliminación al servidor
                eliminarCinta(idCinta);
            }
        });
    });

    function eliminarCinta(idCinta) {
        fetch('/php/delete_cinta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_cinta=${idCinta}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Muestra un mensaje de éxito o error después de la eliminación
            // Recargar la página o actualizar la tabla de inventario si es necesario
        })
        .catch(error => {
            console.error('Error al eliminar la cinta:', error);
        });
    }
});
