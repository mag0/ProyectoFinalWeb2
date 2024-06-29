document.addEventListener("DOMContentLoaded", function() {
    let cantidades = document.getElementsByClassName('cantidad');
    let generos = document.getElementsByClassName('genero');
    let cantidadData = [];
    let generoData = [];

    for (let i = 0; i < cantidades.length; i++) {
        cantidadData.push(parseInt(cantidades[i].textContent));
    }
    for (let i = 0; i < generos.length; i++) {
        let genero = generos[i].textContent;
        if (genero === "M" || genero.toLowerCase() === "masculino") {
            generoData.push("Masculino");
        } else if (genero === "F" || genero.toLowerCase() === "femenino") {
            generoData.push("Femenino");
        } else {
            generoData.push(genero); // Por si hay otros géneros o datos diferentes
        }
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
            categories: generoData
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