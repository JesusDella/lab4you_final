<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vale</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="estilos\estilo_valepdf.css">
</head>

<body>
    <main class="contenido" id="contenedorPrincipal">
        <?php include 'vale_funciones.php'; ?>
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
    <form action="procesar.php" method="post">
    <h1>Práctica: </h1>
    <td><input type="text" name="Practica" /></td>
</form>

</head>

<body>
    <main class="contenido" id="contenedorPrincipal">
        <?php include_once 'vale_funciones.php'; ?>
    <section class="reactivos">
        <div class="tabla-container">
            <table id="tablaReactivos">
                <caption><b>Reactivos</b></caption>
                <thead>
                    <tr>
                        <th>Material</th>
                        <th>Periodo de Tiempo</th>
                        <th>Cap.</th>
                        <th>Marca</th>
                        <th>Nivel Riesgo</th>
                        <th>Condiciones</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo generarSelectMaterial($reactivos); ?></td>
                        <td><input type="text" name="periodoTiempo[]" /></td>
                        <td><input type="text" name="capacidad[]" /></td>
                        <td><input type="text" name="marca[]" /></td>
                        <td><input type="text" name="nivelRiesgo[]" /></td>
                        <td><input type="text" name="condiciones[]" /></td>
                        <td><input type="text" name="comentario[]" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="seccion-agregar-fila">
            <button id="agregar-fila-btn" class="agregar-fila-btn agregar-fila-reactivos">Agregar Fila</button>
        </div>
    </section>


    <section class="equipos">
    <div class="tabla-container">
        <table id="tablaEquipos">
            <caption><b>Equipos</b></caption>
            <thead>
                <tr>
                    <th>Equipo</th>
                    <th>Marca</th>
                    <th>Condiciones</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo generarSelectEquipo($equipos); ?>
                    </td>
                    <td><input type="text" name="marca[]" /></td>
                    <td><input type="text" name="condiciones[]" /></td>
                    <td><input type="text" name="comentarios[]" /></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="seccion-agregar-fila">
        <button id="agregar-fila-btn-equipos" class="agregar-fila-btn agregar-fila-equipos">Agregar Fila</button>
    </div>
</section>

        <section class="prestamo">
    <select id="grupoSelect" class="campo-input">
        <option value="">Seleccione el grupo al que se le asigna esta práctica</option>
        <?php foreach($grupos as $grupo): ?>
            <option value="<?php echo $grupo['id_grupo']; ?>"><?php echo $grupo['nombre_grupo']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="text" id="fechaPrestamo" class="campo-input" placeholder="Seleccione la fecha de préstamo">
    <input type="text" id="fechaPractica" class="campo-input" placeholder="Seleccione la fecha de esta práctica">
</section>

        <section class="consentimiento">
            <p>Firma del Docente: __________________________________</p>
            <p>Firma del Encargado: ________________________________</p>
            <div class="seccion-agregar-fila">

            <button type="button" id="generarVale" class="agregar-fila-btn">Generar Vale</button>


<button id="generarPDF" class="imprimirDocumento">Generar PDF</button>
            </div>
        </section>
    </main>
    <script src="scripts\vale.js"></script>

</body>

</html>