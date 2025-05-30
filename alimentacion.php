<?php
include 'conexion.php';
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT id, animal_id, fecha, tipo_alimento, cantidad FROM alimentacion";
$result = $conn->query($sql);

$alimentacion = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $alimentacion[] = $row;
    }
}

echo json_encode($alimentacion);
$conn->close();
?>
