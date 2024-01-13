<?php
$servername = "localhost";
$username = "tester";
$password = "tester";
$dbname = "vale_pro";

// Conexión a la base de datos
$conexion = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

$nombrePractica = $_POST['nombrePractica'];

// Preparar la consulta para eliminar
$stmt = $conexion->prepare("DELETE FROM Vale WHERE nombre_practica = ?");
$stmt->bind_param("s", $nombrePractica);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Vale eliminado con éxito";
} else {
    echo "Error al eliminar vale: " . $conexion->error;
}

$stmt->close();
$conexion->close();
?>
