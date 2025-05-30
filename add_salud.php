<?php
include 'conexion.php';

// Sólo aceptamos POST y todos los campos
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['animal_id'], $_POST['fecha'], $_POST['descripcion'],
            $_POST['tratamiento'])) {
    http_response_code(400);
    exit('Faltan parámetros o método no permitido');
}

// Escapamos y saneamos
$animal          = $conn->real_escape_string($_POST['animal_id']);
$fecha            = $conn->real_escape_string($_POST['fecha']);
$descripcion=             $conn->real_escape_string($_POST['descripcion']);
$tratamiento            = $conn->real_escape_string($_POST['tratamiento']);

// justo después de include 'conexion.php';
file_put_contents('php://stderr', "POST recibidos: " . print_r($_POST, true));


$sql = "INSERT INTO salud 
          (animal_id, fecha, descripcion, tratamiento) 
        VALUES 
          ('$animal', '$fecha', '$descripcion', '$tratamiento')";

if ($conn->query($sql) === TRUE) {
    echo "Salud guardado correctamente";
} else {
    echo "Error al guardar la salud: " . $conn->error;
}

$conn->close();
?>
