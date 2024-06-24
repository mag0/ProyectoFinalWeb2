
    // Obtener referencia al select y al formulario
    var filtroSelect = document.getElementById('filtroSelect');
    var filtroForm = document.getElementById('filtroForm');

    // Escuchar el evento change en el select
    filtroSelect.addEventListener('change', function() {
    // Activar el envío del formulario al seleccionar una opción
    filtroForm.submit();
});