function openUploadModal() {
    document.getElementById("uploadModal").style.display = "block";
}

function closeUploadModal() {
    document.getElementById("uploadModal").style.display = "none";
}

// Cerrar la ventana modal si se hace clic fuera del contenido
window.onclick = function(event) {
    var modal = document.getElementById("uploadModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
