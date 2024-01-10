<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar PDF</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="estilos\estilo_valepdf.css">
</head>

<body>
    <main class="contenido" id="contenedorPrincipal">
        <?php include 'valepdf.php'; ?>
        <section class="reactivos">
            <div class="tabla-container">
                <table id="tablaReactivos">
                    <caption><b>Reactivos</b></caption>
                    <tr>
                        <th>Cant.</th>
                        <th>Material</th>
                        <th>Periodo de Tiempo</th>
                        <th>Cap.</th>
                        <th>Marca</th>
                        <th>Nivel Riesgo</th>
                        <th>Condiciones</th>
                        <th>Comentario</th>
                    </tr>
                </table>
            </div>
            <div class="seccion-agregar-fila">
                <button class="agregar-fila-btn agregar-fila-reactivos">Agregar Fila</button>
            </div>
        </section>

        <section class="equipos">
            <div class="tabla-container">
                <table id="tablaEquipos">
                    <caption><b>Equipos</b></caption>
                    <tr>
                        <th>Cant.</th>
                        <th>Equipo</th>
                        <th>Marca</th>
                        <th>Condiciones</th>
                        <th>Comentarios</th>
                    </tr>
                </table>
            </div>
            <div class="seccion-agregar-fila">
                <button class="agregar-fila-btn agregar-fila-equipos">Agregar Fila</button>
            </div>
        </section>

        <section class="prestamo">
            <input type="text" id="fechaPrestamo" class="campo-input" placeholder="Seleccione la fecha de préstamo">
            <input type="text" class="campo-input" placeholder="Ingrese el grupo al que se le asigna esta práctica">
            <input type="text" id="fechaPractica" class="campo-input" placeholder="Seleccione la fecha de esta práctica">
        </section>

        <section class="consentimiento">
            <p>Firma del Docente: __________________________________</p>
            <p>Firma del Encargado: ________________________________</p>
            <div class="seccion-agregar-fila">
                <button class="agregar-fila-btn imprimirDocumento">Guardar y Generar PDF</button>
            </div>
        </section>
    </main>
    <script src="scripts\valepdf.js"></script>

</body>

</html>