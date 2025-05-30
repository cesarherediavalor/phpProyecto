<?php
include 'conexion.php';

// Sólo aceptamos POST y todos los campos
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['nombre'], $_POST['apellido'], $_POST['cargo'],
            $_POST['telefono'])) {
    http_response_code(400);
    exit('Faltan parámetros o método no permitido');
}

// Escapamos y saneamos
$nombre          = $conn->real_escape_string($_POST['nombre']);
$apellido            = $conn->real_escape_string($_POST['apellido']);
$cargo=             $conn->real_escape_string($_POST['cargo']);
$telefono            = $conn->real_escape_string($_POST['telefono']);

$sql = "INSERT INTO empleados 
          (nombre, apellido, cargo, telefono) 
        VALUES 
          ('$nombre', '$apellido', '$cargo', '$telefono')";

if ($conn->query($sql) === TRUE) {
    echo "Empleado guardado correctamente";
} else {
    echo "Error al guardar el empleado: " . $conn->error;
}

$conn->close();
?>
