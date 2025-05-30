<?php
include 'conexion.php';
header('Content-Type: application/json; charset=utf-8');

$sql = "SELECT id, nombre, apellido, cargo, telefono FROM empleados";
$result = $conn->query($sql);

$empleados = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $empleados[] = $row;
    }
}

echo json_encode($empleados);
$conn->close();
?>
