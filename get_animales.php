<?php
include 'conexion.php';

$sql = "SELECT id, nombre FROM animales";
$resultado = $conn->query($sql);

$animales = array();

while ($fila = $resultado->fetch_assoc()) {
    $animales[] = array(
        'id' => $fila['id'],
        'nombre' => $fila['nombre']
    );
}

header('Content-Type: application/json');
echo json_encode($animales);
?>
