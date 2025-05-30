<?php
include 'conexion.php';

// Sólo aceptamos POST y todos los campos
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['animal_id'], $_POST['fecha'], $_POST['tipo_alimento'],
            $_POST['cantidad'])) {
    http_response_code(400);
    exit('Faltan parámetros o método no permitido');
}

// Escapamos y saneamos
$animal          = $conn->real_escape_string($_POST['animal_id']);
$fecha            = $conn->real_escape_string($_POST['fecha']);
$tipo=             $conn->real_escape_string($_POST['tipo_alimento']);
$cantidad            = $conn->real_escape_string($_POST['cantidad']);

// justo después de include 'conexion.php';
file_put_contents('php://stderr', "POST recibidos: " . print_r($_POST, true));


$sql = "INSERT INTO alimentacion 
          (animal_id, fecha, tipo_alimento, cantidad) 
        VALUES 
          ('$animal', '$fecha', '$tipo', '$cantidad')";

if ($conn->query($sql) === TRUE) {
    echo "Alimentacion guardado correctamente";
} else {
    echo "Error al guardar la alimentacion: " . $conn->error;
}

$conn->close();
?>
