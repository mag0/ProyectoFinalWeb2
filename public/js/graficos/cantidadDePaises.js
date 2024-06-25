
let jugadores = document.getElementsByClassName('paises');
let fechas = document.getElementsByClassName('pais');
let juga = [];
let countries = [];

for (let i=0;i<jugadores.length;i++){
    juga.push(jugadores[i].textContent)
}
for (let i=0;i<fechas.length;i++){
    countries.push(fechas[i].textContent)
}

var options = {
    chart: {
        type: 'bar',
        height: 350,
        toolbar: {
            show: false
        }
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
            dataLabels: {
                position: 'top', // Posición de las etiquetas (top, center, bottom, etc.)
                enabled: true,   // Habilitar etiquetas
                formatter: function(val) {
                    return val; // Formato de la etiqueta, puede personalizarse según sea necesario
                },
                offsetY: -20,  // Ajuste vertical de la posición de las etiquetas
                style: {
                    fontSize: '12px',
                    colors: ["#304758"]
                }
            }
        }
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: countries, // Aquí se deben proporcionar las categorías para el eje X
        labels: {
            style: {
                fontSize: '14px'
            }
        }
    },
    series: [{
        name: 'Cantidad por país',
        data: juga // Aquí se deben proporcionar los datos de las series
    }],
    fill: {
        colors: ['#6A5ACD']
    }
};

var chart = new ApexCharts(document.getElementById('chart'), options);
chart.render();

