$(document).ready(function () {
    // Inicialización de los selectores de fecha
    $("#fechaPrestamo, #fechaPractica").datepicker({
        dateFormat: "yy-mm-dd"
    });

    // Evento para agregar filas a la tabla de reactivos
    $('.agregar-fila-reactivos').click(function () {
        agregarFila("tablaReactivos");
    });

    // Evento para agregar filas a la tabla de equipos
    $('.agregar-fila-equipos').click(function () {
        agregarFila("tablaEquipos");
    });

    // Evento para manejar el envío del formulario y generación de PDF
    $('#prestamoForm').on('submit', function(event) {
        event.preventDefault();

        // Validación de los campos del formulario
        if (validarFormulario()) {
            // Generación del PDF
            html2pdf().from(document.body).save('prestamo.pdf');
        } else {
            alert('Por favor, complete todos los campos requeridos.');
        }
    });
});

// Función para agregar una fila a la tabla especificada
function agregarFila(tablaId) {
    var tabla = document.getElementById(tablaId);
    if (!tabla) {
        console.error('Tabla no encontrada: ' + tablaId);
        return;
    }

    var nuevaFila = tabla.insertRow(-1);
    var numCeldas = tabla.rows[0].cells.length;

    for (var i = 0; i < numCeldas; i++) {
        var celda = nuevaFila.insertCell(i);
        celda.innerHTML = "<input type='text'>";
    }
}

// Función para validar el formulario
function validarFormulario() {
    var fechaPrestamo = document.getElementById('fechaPrestamo').value.trim();
    var fechaPractica = document.getElementById('fechaPractica').value.trim();

    // Validar fechas de préstamo y práctica
    if (fechaPrestamo === '' || fechaPractica === '') {
        return false;
    }

    // Validar si hay al menos un reactivo o equipo
    var tablaReactivos = document.getElementById('tablaReactivos');
    var tablaEquipos = document.getElementById('tablaEquipos');

    if (tablaReactivos.rows.length <= 1 && tablaEquipos.rows.length <= 1) {
        // Considerando que la primera fila es el encabezado
        return false;
    }
    return true;
}
