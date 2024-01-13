$(document).ready(function () {
    // Inicialización de los selectores de fecha
    $("#fechaPrestamo, #fechaPractica").datepicker({
        dateFormat: "yy-mm-dd"
    });

    // Evento para agregar filas a la tabla de reactivos
    $('.agregar-fila-reactivos').click(function () {
        agregarFilaReactivos();
    });

    // Evento para agregar filas a la tabla de equipos
    $('#agregar-fila-btn-equipos').click(function () {
        agregarFilaEquipos();
    });

    $(document).ready(function () {
        $('#generarVale').click(function () {
            var idGrupo = $('#grupoSelect').val();
            var nombrePractica = $('input[name="Practica"]').val();
            var fechaPrestamo = $('#fechaPrestamo').val();
            var fechaPractica = $('#fechaPractica').val();
    
            $.ajax({
                type: 'POST',
                url: 'guardar_vale.php',
                data: {
                    id_grupo: idGrupo,
                    nombre_practica: nombrePractica,
                    fecha_prestamo: fechaPrestamo,
                    fecha_practica: fechaPractica
                },
                success: function(response) {
                    alert(response); // Muestra la respuesta del servidor como una alerta
                },
                error: function(xhr, status, error) {
                    alert("Error al intentar guardar: " + error); // Muestra un mensaje de error
                }
            });
        });

    });
    
    


    $(document).ready(function() {
        $('#generarPDF').click(function () {
            var element = document.getElementById("contenedorPrincipal");
    
            //html2pdf
            var opt = {
                margin: [0.5, 1],
                filename: 'documento.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, y: 0 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
            };
    
            // Generar y guardar el PDF
            html2pdf().from(element).set(opt).save();
        });
    });
    
    

    
    
    $('#formularioVale').submit(function(event) {
        event.preventDefault();
        if (validarFormulario()) {
            var datosFormulario = $(this).serialize();
    
            $.ajax({
                type: 'POST',
                url: 'boton_guardar_vale.php', 
                data: datosFormulario,
                success: function(response) {
                    if (response === 'success') {
                        html2pdf().from(document.body).save('vale.pdf');
                    } else {
                        alert('Error al guardar los datos del vale: ' + response);
                    }
                },
                error: function() {
                    alert('Error al procesar el formulario');
                }
            });
        } else {
            alert('Por favor, complete todos los campos requeridos.');
        }
    });
    
});
function agregarFilaReactivos() {
    var tabla = $('#tablaReactivos tbody');
    var filaOriginal = tabla.find('tr:first');
    var nuevaFila = filaOriginal.clone();

    nuevaFila.find('input[type="text"], input[type="number"], select').val('').prop('selectedIndex', 0);
    tabla.append(nuevaFila);
}

function agregarFilaEquipos() {
    var tabla = $('#tablaEquipos tbody');
    var filaOriginal = tabla.find('tr:first');
    var nuevaFila = filaOriginal.clone();

    nuevaFila.find('input[type="text"], input[type="number"]').val('');
     tabla.append(nuevaFila);
}



$(document).on('change', '.selectReactivo', function() {
    rellenarCampos(this);
});
function rellenarCampos(selectElement) {
    var idReactivo = selectElement.value;
    var datosReactivo = reactivos[idReactivo];

    if (!datosReactivo) {
        return; 
    }

    var fila = $(selectElement).closest('tr');

    fila.find('[name="cantidad[]"]').val(datosReactivo.cantidad || '');
    fila.find('[name="periodoTiempo[]"]').val(datosReactivo.periodo_tiempo || '');
    fila.find('[name="capacidad[]"]').val(datosReactivo.capacidad || '');
    fila.find('[name="marca[]"]').val(datosReactivo.marca || '');
    fila.find('[name="nivelRiesgo[]"]').val(datosReactivo.nivel_riesgo || '');
    fila.find('[name="condiciones[]"]').val(datosReactivo.condiciones || '');
    fila.find('[name="comentario[]"]').val(datosReactivo.comentarios || '');
}

function rellenarCamposEquipos(selectElement) {
    var idEquipo = selectElement.value;
    var datosEquipo = equipos[idEquipo];

    if (!datosEquipo) {
        return; 
    }

    var fila = selectElement.closest('tr');

    fila.querySelector('[name="marca[]"]').value = datosEquipo.marca || '';
    fila.querySelector('[name="condiciones[]"]').value = datosEquipo.condiciones || '';
    fila.querySelector('[name="comentarios[]"]').value = datosEquipo.comentarios || '';
}





