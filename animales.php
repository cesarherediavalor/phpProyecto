<?php
include 'conexion.php';
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT animal_id, nombre, raza, fecha_nacimiento, sexo, peso, estado_salud FROM animales";
$result = $conn->query($sql);

$animales = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $animales[] = $row;
    }
}

echo json_encode($animales);
$conn->close();
?>
