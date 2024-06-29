document.addEventListener("DOMContentLoaded", function() {
    let porcentaje = document.getElementsByClassName('porcentaje');
    let usuario = document.getElementsByClassName('usuario');
    let porcentajeData = [];
    let usuarioData = [];

    for (let i = 0; i < porcentaje.length; i++) {
        porcentajeData.push(parseInt(porcentaje[i].textContent));
    }
    for (let i = 0; i < usuario.length; i++) {
        usuario.push(usuario[i].textContent);
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
            categories: usuarioData
        },
        series: [{
            name: 'Cantidad de Usuarios',
            data: porcentajeData
        }],
        fill: {
            colors: ['#6A5ACD']
        }
    };

    var chart = new ApexCharts(document.getElementById('chart'), options);
    chart.render();
});