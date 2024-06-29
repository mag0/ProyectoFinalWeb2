
let jugadores = document.getElementsByClassName('partidas');
let fechas = document.getElementsByClassName('fecha');
let juga = [];
let fecha = [];

for (let i=0;i<jugadores.length;i++){
    juga.push(jugadores[i].textContent)
}
for (let i=0;i<fechas.length;i++){
    fecha.push(fechas[i].textContent)
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
            endingShape: 'rounded'
        },
    },
    dataLabels: {
        enabled: false
    },
    xaxis: {
        categories: fecha,
        title: {
            text: 'Categoría de Fecha'
        }
    },
    yaxis: {
        title: {
            text: 'Cantidad de partidas'
        }
    },
    series: [{
        name: 'Cantidad de partidas',
        data: juga
    }],
    fill: {
        colors: ['#6A5ACD']
    }
};

var chart = new ApexCharts(document.getElementById('chart'), options);
chart.render();

