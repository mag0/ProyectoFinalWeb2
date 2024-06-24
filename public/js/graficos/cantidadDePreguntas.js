
let jugadores = document.getElementsByClassName('preguntas');
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
        categories: fecha
    },
    series: [{
        name: 'Cantidad de preguntas',
        data: juga
    }],
    fill: {
        colors: ['#6A5ACD']
    }
};

var chart = new ApexCharts(document.getElementById('chart'), options);
chart.render();

