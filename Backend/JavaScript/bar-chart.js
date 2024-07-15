document.addEventListener('DOMContentLoaded', function() {
    // Obtener el contexto del canvas
    var ctx = document.getElementById('cintasPorClienteChart').getContext('2d');

    // Datos de ejemplo de la base de datos
    var datos = {
        labels: ['BAC', 'CISA', 'ELCATEX', 'FICENSA', 'GILDAN', 'INJUPEMP'],
        datasets: [{
            label: 'Cantidad de Cintas',
            data: [40, 2, 8, 4, 6, 3], // Aquí irían los datos reales de cantidad de cintas por cliente
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Configuración del gráfico
    var config = {
        type: 'bar',
        data: datos,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Crear el gráfico
    var myChart = new Chart(ctx, config);
});
