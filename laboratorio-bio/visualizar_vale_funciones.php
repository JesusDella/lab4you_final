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

// Consulta SQL para obtener los nombres de las prácticas
$sql = "SELECT nombre_practica FROM Vale";
$resultado = $conexion->query($sql);

$practicas = array();

// Verificar si la consulta tiene resultados
if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $practicas[] = $fila;
    }
}
echo json_encode($practicas);
$conexion->close();
?>
