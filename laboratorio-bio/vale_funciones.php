<?php
$servername = "localhost";
$username = "tester";
$password = "tester";
$dbname = "vale_pro";

// Intentar conectar a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexion
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

// Funcion para obtener los detalles de un reactivo
function obtenerDetallesReactivo($idReactivo, $conexion) {
    $detalles = array();
    $sql = "SELECT * FROM Reactivos WHERE id_reactivo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idReactivo);
    if ($stmt->execute()) {
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $detalles = $resultado->fetch_assoc();
        }
    }
    $stmt->close();
    return $detalles;
}

// Funcion para obtener los detalles de un equipo
function obtenerDetallesEquipo($idEquipo, $conexion) {
    $detalles = array();
    $sql = "SELECT * FROM Equipos WHERE id_equipo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idEquipo);
    if ($stmt->execute()) {
        $resultado = $stmt->get_result();
        if ($resultado->num_rows > 0) {
            $detalles = $resultado->fetch_assoc();
        }
    }
    $stmt->close();
    return $detalles;
}

// Obtener reactivos
$sqlReactivos = "SELECT id_reactivo, nombre_reactivo FROM Reactivos";
$resultadoReactivos = $conexion->query($sqlReactivos);
$reactivos = array();
if ($resultadoReactivos->num_rows > 0) {
    while($fila = $resultadoReactivos->fetch_assoc()) {
        $idReactivo = $fila['id_reactivo'];
        $reactivos[$idReactivo] = obtenerDetallesReactivo($idReactivo, $conexion);
    }
} else {
    echo "0 resultados en reactivos";
}

// Obtener equipos
$sqlEquipos = "SELECT id_equipo, nombre_equipo FROM Equipos";
$resultadoEquipos = $conexion->query($sqlEquipos);
$equipos = array();
if ($resultadoEquipos->num_rows > 0) {
    while($filaEquipo = $resultadoEquipos->fetch_assoc()) {
        $equipos[$filaEquipo['id_equipo']] = obtenerDetallesEquipo($filaEquipo['id_equipo'], $conexion);
    }
} else {
    echo "0 resultados en equipos";
}

// Generar menu desplegable para reactivos
function generarSelectMaterial($reactivos) {
    $html = '<select name="material[]" class="campo-input materialSelect" onchange="rellenarCampos(this)">';
    $html .= '<option value="">Seleccione el material</option>';
    foreach($reactivos as $idReactivo => $detalleReactivo) {
        $html .= '<option value="' . htmlspecialchars($idReactivo) . '">' . htmlspecialchars($detalleReactivo['nombre_reactivo']) . '</option>';
    }
    $html .= '</select>';
    return $html;
}

function generarSelectEquipo($equipos) {
    $html = '<select name="equipo[]" class="campo-input equipoSelect" onchange="rellenarCamposEquipos(this)">';
    $html .= '<option value="">Seleccione el equipo</option>';
    foreach($equipos as $equipo) {
        $html .= '<option value="' . htmlspecialchars($equipo['id_equipo']) . '">' . htmlspecialchars($equipo['nombre_equipo']) . '</option>';
    }
    $html .= '</select>';
    return $html;
}


// Obtener grupos
$sqlGrupos = "SELECT id_grupo, nombre_grupo FROM Grupos";
$resultadoGrupos = $conexion->query($sqlGrupos);
$grupos = [];
if ($resultadoGrupos->num_rows > 0) {
    while($fila = $resultadoGrupos->fetch_assoc()) {
        $grupos[] = $fila;
    }
}



// Cerrar la conexion a la base de datos
$conexion->close();
?>

<script>
var reactivos = <?php echo json_encode($reactivos); ?>;</script>
<script>
var equipos = <?php echo json_encode($equipos); ?>;
</script>

