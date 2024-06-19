// Función para descargar el gráfico como PDF
function downloadPDF() {
    // Configuración para html2pdf.js
    var element = document.getElementById("chart"); // Elemento que deseas convertir a PDF
    var opt = {
        margin:       0.5,
        filename:     'grafico.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'landscape' }
    };

    // Llama a html2pdf para generar el PDF
    html2pdf().from(element).set(opt).save();
}

// Asigna el evento clic al botón de descarga
document.getElementById('download-pdf').addEventListener('click', downloadPDF);