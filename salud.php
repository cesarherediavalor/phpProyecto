<?php
include 'conexion.php';
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT id, animal_id, fecha, descripcion, tratamiendo FROM salud";
$result = $conn->query($sql);

$salud = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $salud[] = $row;
    }
}

echo json_encode($salud);
$conn->close();
?>
