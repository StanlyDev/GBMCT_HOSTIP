document.getElementById('download-pdf').addEventListener('click', () => {
    const element = document.querySelector('header'); // Selecciona el contenido del header
    const opt = {
        margin: 0.0,
        filename: 'documento.pdf',
        image: { type: 'jpeg', quality: 1.0 },
        html2canvas: { scale: 5 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    // Obtener el tamaño del contenido y ajustar la escala si es necesario
    html2pdf().from(element).set(opt).toPdf().get('pdf').then(function (pdf) {
        const totalPages = pdf.internal.getNumberOfPages();
        for (let i = 1; i <= totalPages; i++) {
            pdf.setPage(i);
            const width = pdf.internal.pageSize.getWidth();
            const height = pdf.internal.pageSize.getHeight();
            // Ajustar el tamaño del contenido para que quepa en una página
            pdf.internal.scaleFactor = Math.min(width / element.offsetWidth, height / element.offsetHeight);
        }

        // Guardar el PDF
        html2pdf().from(element).set(opt).save('documento.pdf');

        // Esperar 2 segundos antes de redirigir a la nueva página
        setTimeout(function() {
            window.location.href = '/Frontend/Pages/UpdateFile.php'; // Reemplaza con la URL correcta
        }, 2000); // Tiempo en milisegundos (en este caso, 2 segundos)
    });
});
