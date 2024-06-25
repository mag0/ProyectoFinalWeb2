var modal = document.getElementById("qrModal");
var span = document.getElementsByClassName("close")[0];
let n = document.getElementById("n").textContent;

function generateQR() {
    // URL del perfil del usuario para el QR (puedes modificar según sea necesario)
    var userProfileUrl = "http://localhost/ProyectoFinal/index.php?controller=lobby&action=verPerfil&usuarioBuscado=" + n;

    // Genera el código QR en el contenedor especificado
    var qrcode = new QRCode(document.getElementById("qr-container"), {
        text: userProfileUrl,
        width: 128,
        height: 128,
    });

    // Muestra el modal
    modal.style.display = "block";
}

document.getElementById('toggleQRButton').addEventListener('click', function () {
    // Limpiar el contenido del QR antes de generar uno nuevo
    document.getElementById('qr-container').innerHTML = '';
    generateQR();
});

// Cierra el modal cuando el usuario hace clic en <span> (x)
span.onclick = function() {
    modal.style.display = "none";
    document.getElementById('qr-container').innerHTML = '';
}

// Cierra el modal cuando el usuario hace clic fuera del modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.getElementById('qr-container').innerHTML = '';
    }
}