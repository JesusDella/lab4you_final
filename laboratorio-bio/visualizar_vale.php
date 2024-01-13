<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Vales</title>
    <link rel="stylesheet" href="estilos/estilo_general.css">
    <link rel="stylesheet" href="estilos/estilo_visualizar_vale.css">
</head>
<body>

    <header>
        <img src="images/logo_lab.jpg" alt="Imagen de un equipo">
        <li><a>Mis vales</a></li>
        <nav>
            <ul class="menu">
                <li><a href="index.html">Inicio</a></li>
                <li><a href="reportar.html">Reportar error</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="vales">   
            <a href="vale.php">
                <button class="boton">Generar nuevo vale</button>
            </a>
        </section>

        <section class="llenado">
            <input type="text" placeholder="Nombre de la práctica">
        </section>

        <div id="practicasContainer" style="margin: 20px 0;"></div>
    </main>

    <script>
        window.onload = function() {
    fetch('visualizar_vale_funciones.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        console.log('Data received:', data); 
        const container = document.getElementById('practicasContainer');
        if (!container) {
            throw new Error('Container not found');
        }
        container.innerHTML = ''; 
        data.forEach(practica => {
            const div = document.createElement('div');
            div.className = 'practica-item';
            div.innerHTML = `
                <p>${practica.nombre_practica}</p>
                <button onclick="hacerPrestamo('${practica.nombre_practica}')">Solicitar prestamo</button>
                <button onclick="verVale('${practica.nombre_practica}')">Ver Vale</button>
                <button onclick="eliminarVale('${practica.nombre_practica}')">Eliminar Vale</button>
            `;
            container.appendChild(div);
        });
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
};

function verVale(nombrePractica) {
    console.log("Ver Vale", nombrePractica);
}

function eliminarVale(nombrePractica) {
    console.log("Eliminar Vale", nombrePractica);

    fetch('visualiza_vale_eliminar.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'nombrePractica=' + encodeURIComponent(nombrePractica)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(text => {
        console.log(text);
        // Recarga la página después de eliminar el vale
        window.location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



    </script>
</body>
</html>
