let countdownValue = 30;
let countdownInterval;

function startCountdown() {
    countdownInterval = setInterval(updateCountdown, 1000);
}

function updateCountdown() {
    countdownValue--;
    document.getElementById("countdown").textContent = countdownValue;
    if (countdownValue === 0) {
        clearInterval(countdownInterval);
        window.location.href = "/ProyectoFinal/index.php?controller=partida&action=verificarRespuesta&tiempo";
    }
}

/* Función para verificar la respuesta
function verificarRespuesta(respuestaSeleccionada) {
    clearInterval(countdownInterval); // Detiene el contador al seleccionar una respuesta
    // Aquí iría tu lógica para verificar la respuesta seleccionada
    // Luego redirige a la página de resultado y pasa el tiempo restante como parámetro
    window.location.href = "/ProyectoFinal/index.php?controller=partida&action=verificarRespuesta&tiempo=" + countdownValue;
}*/