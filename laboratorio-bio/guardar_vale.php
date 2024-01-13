<?php
$servername = "localhost";
$username = "tester";
$password = "tester";
$dbname = "vale_pro";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("La conexión falló: " . $conexion->connect_error);
}

$id_grupo = $_POST['id_grupo'];
$nombre_practica = $_POST['nombre_practica'];
$fecha_prestamo = $_POST['fecha_prestamo'];
$fecha_practica = $_POST['fecha_practica'];

$sql = "INSERT INTO Vale (id_grupo, nombre_practica, fecha_prestamo, fecha_practica) VALUES (?, ?, ?, ?)";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("isss", $id_grupo, $nombre_practica, $fecha_prestamo, $fecha_practica);

if ($stmt->execute()) {
    echo "Nuevo vale creado con éxito";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conexion->close();
?>
