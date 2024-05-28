function showOptions() {
    // Cerrar el menú principal en pantallas pequeñas
    if (window.innerWidth <= 767) {
        toggleMenu(); // Aquí deberías tener una función que cierra el menú, ajusta según tu implementación
    }

    if (window.innerWidth <= 1280) {
        toggleMenu(); // Aquí deberías tener una función que cierra el menú, ajusta según tu implementación
    }

    // Mostrar el modal
    document.getElementById('myModal').style.display = 'block';
}

function closeOptions() {
    document.getElementById('myModal').style.display = 'none';
}

document.querySelector('.generate-doc').addEventListener('click', function () {
    this.classList.add('active');
});
