document.addEventListener('DOMContentLoaded', function() {
    cargarPracticas();
});

function cargarPracticas() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'cargarPracticas.php', true);

    xhr.onload = function() {
        if (this.status === 200) {
            try {
                var practicas = JSON.parse(this.responseText);
                var html = practicas.length > 0 ? '<ul>' : '<p>No hay prácticas disponibles.</p>';
                
                practicas.forEach(function(practica) {
                    html += '<li>' + practica + '</li>';
                });

                if (practicas.length > 0) {
                    html += '</ul>';
                }

                document.getElementById('listaPracticas').innerHTML = html;
            } catch (e) {
                console.error("Hubo un error al procesar la respuesta: ", e);
                document.getElementById('listaPracticas').innerHTML = '<p>Error al cargar las prácticas.</p>';
            }
        } else {
            console.error("Error en la solicitud: ", this.status);
            document.getElementById('listaPracticas').innerHTML = '<p>Error al cargar las prácticas.</p>';
        }
    }

    xhr.onerror = function() {
        console.error("Error en la solicitud a 'cargarPracticas.php'.");
        document.getElementById('listaPracticas').innerHTML = '<p>No se pudo conectar con el servidor.</p>';
    }

    xhr.send();
}
