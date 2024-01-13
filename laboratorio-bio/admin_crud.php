<?php
$servername = "localhost";
$username = "tester";
$password = "tester";
$dbname = "vale_pro";

// Crear conexinn
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$seccion = $_GET['seccion'] ?? 'reactivos';

switch($seccion) {
    case 'reactivos':
        $sql = "SELECT id_reactivo, nombre_reactivo FROM Reactivos";
        break;
    case 'equipos':
        $sql = "SELECT id_equipo, nombre_equipo FROM Equipos";
        break;
    case 'grupos':
        $sql = "SELECT id_grupo, nombre_grupo FROM Grupos";
        break;
    default:
        echo "Sección no válida";
        $conn->close();
        exit;
}

$result = $conn->query($sql);

$elementos = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $elementos[] = $row;
    }
    echo json_encode($elementos);
} else {
    echo "0 resultados en la sección " . $seccion;
}

if(isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
    $id = $_GET['id'];
    $seccion = $_GET['seccion'];
    switch($seccion) {
        case 'reactivos':
            $sql = "DELETE FROM Reactivos WHERE id_reactivo = ?";
            break;
        case 'equipos':
            $sql = "DELETE FROM Equipos WHERE id_equipo = ?";
            break;
        case 'grupos':
            $sql = "DELETE FROM Grupos WHERE id_grupo = ?";
            break;
        default:
            echo "Sección no válida para eliminar";
            exit;
    }

    if($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if($stmt->execute()) {
            echo "Elemento eliminado con éxito";
        } else {
            echo "Error al eliminar el elemento";
        }
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta";
    }
    $conn->close();
}
$conn->close();
?>
