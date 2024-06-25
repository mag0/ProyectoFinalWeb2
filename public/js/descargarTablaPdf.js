document.getElementById('download-pdf').addEventListener('click', function() {
    const element = document.getElementById('tablaPorcentajes');
    html2pdf().from(element).set({
        margin:       1,
        filename:     'tabla_porcentajes.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    }).save();
    console.log("no")
});
console.log("si")