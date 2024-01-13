<?php
$servername = "localhost";
$username = "tester";
$password = "tester";
$dbname = "vale_pro";

// Intentar conectar a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

function almacenarDatos($idGrupo, $idsEquipos, $idsReactivos, $nombrePractica, $fechaPrestamo, $fechaPractica) {
    $datos = array(
        "idGrupo" => $idGrupo,
        "idsEquipos" => $idsEquipos,
        "idsReactivos" => $idsReactivos,
        "nombrePractica" => $nombrePractica,
        "fechaPrestamo" => $fechaPrestamo,
        "fechaPractica" => $fechaPractica
    );

    return $datos;
}


// Cerrar la conexión a la base de datos
$conexion->close();
?>
