document.addEventListener("DOMContentLoaded", function() {
    let cantidades = document.getElementsByClassName('cantidad');
    let edades = document.getElementsByClassName('edad');
    let cantidadData = [];
    let edadData = [];

    for (let i = 0; i < cantidades.length; i++) {
        cantidadData.push(parseInt(cantidades[i].textContent));
    }
    for (let i = 0; i < edades.length; i++) {
        edadData.push(edades[i].textContent);
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
            categories: edadData,
            title: {
                text: 'Categoría de Edad'
            }
        },
        yaxis: {
            title: {
                text: 'Cantidad de Usuarios'
            }
        },
        series: [{
            name: 'Cantidad de Usuarios',
            data: cantidadData
        }],
        fill: {
            colors: ['#6A5ACD']
        }
    };

    var chart = new ApexCharts(document.getElementById('chart'), options);
    chart.render();
});