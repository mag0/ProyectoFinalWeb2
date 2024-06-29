document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencia al select y al formulario
    var filtroSelect = document.getElementById('filtroSelect');
    var filtroForm = document.getElementById('filtroForm');

    // Verificar que ambos elementos existen en el DOM
    if (filtroSelect && filtroForm) {
        // Escuchar el evento change en el select
        filtroSelect.addEventListener('change', function() {
            // Activar el envío del formulario al seleccionar una opción
            filtroForm.submit();
        });
    } else {
        console.error("El formulario o el select no se encontraron en el DOM.");
    }
});