<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Laboratorio</title>
    <link rel="stylesheet" href="estilos/estilo_admin_crud.css">
</head>
<body>
    <header>
        <h1>Gestión de Laboratorio</h1>
    </header>

    <main>
        <!-- Seccion Reactivos -->
        <section id="seccion-reactivos">
    <h2>Reactivos</h2>
    <div class="acciones">
        <button class="btn" onclick="mostrarFormulario('reactivos')">Añadir Reactivo</button>
    </div>
    <div id="formulario-reactivos" class="formulario" style="display:none;">
        <!-- Formulario para añadir nuevos reactivos -->
        <input type="text" id="nombre-reactivo" placeholder="Nombre del Reactivo" />
        <input type="text" id="periodo-tiempo-reactivo" placeholder="Periodo de Tiempo" />
        <input type="text" id="capacidad-reactivo" placeholder="Capacidad" />
        <input type="text" id="marca-reactivo" placeholder="Marca" />
        <input type="text" id="nivel-riesgo-reactivo" placeholder="Nivel de Riesgo" />
        <input type="text" id="condiciones-reactivo" placeholder="Condiciones" />
        <textarea id="comentarios-reactivo" placeholder="Comentarios"></textarea>
        <button class="btn" id="guardarElemento">Guardar</button>
    </div>
    <div id="lista-reactivos" class="lista-reactivos">
        <!-- Aquí se mostrarán los reactivos -->
    </div>
</section>


        <!-- Sección Equipos -->
        <section id="seccion-equipos">
            <h2>Equipos</h2>
            <div class="acciones">
                <button class="btn" onclick="mostrarFormulario('equipos')">Añadir Equipo</button>
                <button class="btn" onclick="verElementos('equipos')">Ver Equipos</button>
    <div id="lista-equipos" class="lista-equipos">
        <!-- Aquí se mostrarán los equipos -->
    </div>
            </div>
            <div id="formulario-equipos" class="formulario" style="display:none;">
                <!-- Formulario para añadir nuevos equipos -->
                <input type="text" id="nombre-equipo" placeholder="Nombre del Equipo" />
                <input type="number" id="cantidad-equipo" placeholder="Cantidad" />
                <input type="text" id="marca-equipo" placeholder="Marca" />
                <input type="text" id="condiciones-equipo" placeholder="Condiciones" />
                <textarea id="comentarios-equipo" placeholder="Comentarios"></textarea>
                <button class="btn" onclick="guardarElemento('equipos')">Guardar</button>
            </div>
        </section>
        <section id="seccion-grupos">
            <h2>Grupos</h2>
            <div class="acciones">
                <button class="btn" onclick="mostrarFormulario('grupos')">Añadir Grupo</button>
                <button class="btn" onclick="verElementos('grupos')">Ver Grupos</button>
    <div id="lista-grupos" class="lista-grupos">
            </div>
            <div id="formulario-grupos" class="formulario" style="display:none;">
                <!-- Formulario para añadir nuevos grupos -->
                <input type="text" id="nombre-grupo" placeholder="Nombre del Grupo" />
                <button class="btn" onclick="guardarElemento('grupos')">Guardar</button>
            </div>
        </section>

        <section id="seccion-prestamos">
            <h2>Gestionar prestamos</h2>
            <div class="acciones">
                <button class="btn" onclick="mostrarFormulario('grupos')">Declinar prestamo</button>
                <button class="btn" onclick="verElementos('grupos')">Aceptar prestamo</button>
                <button class="btn" onclick="verElementos('grupos')">Finalizar prestamo</button>
            </div>
            <div id="formulario-grupos" class="formulario" style="display:none;">
                <!-- Formulario para añadir nuevos grupos -->
                <input type="text" id="nombre-grupo" placeholder="Nombre del Grupo" />
                <button class="btn" onclick="guardarElemento('grupos')">Guardar</button>
            </div>
        </section>
    </main>

    <footer>
    </footer>
    <script src="scripts\admin_crud.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('formulario-grupos').style.display = 'none';
    document.getElementById('formulario-reactivos').style.display = 'none';
    document.getElementById('formulario-equipos').style.display = 'none';
    verElementos('reactivos');
});

function mostrarFormulario(seccion) {
    var formulario = document.getElementById('formulario-' + seccion);
    formulario.style.display = formulario.style.display === 'none' ? 'block' : 'none';
    ['grupos', 'reactivos', 'equipos'].forEach(function(s) {
        if (s !== seccion) {
            document.getElementById('formulario-' + s).style.display = 'none';
        }
    });
}

function verElementos(seccion) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                var elementos = JSON.parse(this.responseText);
            } catch(e) {
                console.error("Error al parsear respuesta: ", e);
                return;
            }

            var html = '<ul>';
            elementos.forEach(function(elemento) {
                var nombreElemento, idElemento;
                switch(seccion) {
                    case 'reactivos':
                        nombreElemento = elemento.nombre_reactivo;
                        idElemento = elemento.id_reactivo;
                        break;
                    case 'equipos':
                        nombreElemento = elemento.nombre_equipo;
                        idElemento = elemento.id_equipo;
                        break;
                    case 'grupos':
                        nombreElemento = elemento.nombre_grupo;
                        idElemento = elemento.id_grupo;
                        break;
                }

                html += '<li>' + nombreElemento +
                        ' <button onclick="editarElemento(' + idElemento + ', \'' + seccion + '\')">Editar</button>' +
                        ' <button onclick="eliminarElemento(' + idElemento + ', \'' + seccion + '\')">Eliminar</button></li>';
            });
            html += '</ul>';
            document.getElementById("lista-" + seccion).innerHTML = html;
        }
    };
    xhttp.open("GET", "admin_crud.php?seccion=" + seccion, true);
    xhttp.send();
}

function editarElemento(id, seccion) {
    console.log('Editando elemento ' + id + ' de ' + seccion);
    // Aquí puedes agregar la lógica para editar el elemento
}

function eliminarElemento(id, seccion) {
    var confirmacion = confirm("¿Estás seguro de que deseas eliminar este elemento?");
    if (confirmacion) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                verElementos(seccion); // Recargar la lista
            }
        };
        xhttp.open("GET", "admin_crud.php?accion=eliminar&seccion=" + seccion + "&id=" + id, true);
        xhttp.send();
    }
}

function guardarElemento(seccion) {
    // Aquí puedes agregar la lógica para guardar un nuevo elemento
}

</script>
</body>
</html>
