<?php
// Definir las credenciales de la base de datos
$servername = "localhost";
$username = "root";
$password = "RADIOHEAD0450";
$dbname = "vale";

// Intentar conectar a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}


// Función para obtener grupos
function obtenerGrupos($conexion) {
    $sql = "SELECT id_grupo, nombre_grupo FROM Grupos";
    if ($resultado = $conexion->query($sql)) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='" . $fila['id_grupo'] . "'>" . $fila['nombre_grupo'] . "</option>";
        }
    }
}

// Función para obtener reactivos
function obtenerReactivos($conexion) {
    $sql = "SELECT id_reactivo, nombre_reactivo FROM Reactivos";
    if ($resultado = $conexion->query($sql)) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='" . $fila['id_reactivo'] . "'>" . $fila['nombre_reactivo'] . "</option>";
        }
    }
}

// Función para obtener equipos
function obtenerEquipos($conexion) {
    $sql = "SELECT id_equipo, nombre_equipo FROM Equipos";
    if ($resultado = $conexion->query($sql)) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<option value='" . $fila['id_equipo'] . "'>" . $fila['nombre_equipo'] . "</option>";
        }
    }
}

// Función para guardar el préstamo
function guardarPrestamo($conexion, $idGrupo, $idReactivo, $idEquipo) {
    // Inicia transacción
    $conexion->begin_transaction();

    try {
        // Insertar en la tabla de préstamos
        $sql = "INSERT INTO Prestamos (id_grupo) VALUES (?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idGrupo);
        $stmt->execute();
        $idPrestamo = $stmt->insert_id;

        // Insertar en DetallePrestamoEquipos
        $sql = "INSERT INTO DetallePrestamoEquipos (id_prestamo, id_equipo, cantidad) VALUES (?, ?, 1)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $idPrestamo, $idEquipo);
        $stmt->execute();

        // Insertar en DetallePrestamoReactivos
        $sql = "INSERT INTO DetallePrestamoReactivos (id_prestamo, id_reactivo, cantidad) VALUES (?, ?, 1)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ii", $idPrestamo, $idReactivo);
        $stmt->execute();


        $conexion->commit();
        return true;
    } catch (Exception $e) {
        $conexion->rollback();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y validar datos del POST
    $idGrupo = $_POST['grupo'] ?? null;
    $idReactivo = $_POST['reactivo'] ?? null;
    $idEquipo = $_POST['equipo'] ?? null;

    if (!$idGrupo || !$idReactivo || !$idEquipo) {
        echo "Datos inválidos";
        exit;
    }

    if (guardarPrestamo($conexion, $idGrupo, $idReactivo, $idEquipo)) {
        echo "Préstamo guardado con éxito";
    } else {
        echo "Error al guardar el préstamo";
    }
}

$conexion->close();
?>