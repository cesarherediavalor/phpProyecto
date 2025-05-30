<?php
include 'conexion.php';
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT id, animal_id, fecha_mate, resultado, observaciones FROM reproduccion";
$result = $conn->query($sql);

$reproduccion = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $reproduccion[] = $row;
    }
}

echo json_encode($reproduccion);
$conn->close();
?>
