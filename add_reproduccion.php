<?php
include 'conexion.php';

// Sólo aceptamos POST y todos los campos
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['animal_id'], $_POST['fecha_mate'], $_POST['resultado'],
            $_POST['observaciones'])) {
    http_response_code(400);
    exit('Faltan parámetros o método no permitido');
}

// Escapamos y saneamos
$animal          = $conn->real_escape_string($_POST['animal_id']);
$fecha            = $conn->real_escape_string($_POST['fecha_mate']);
$resultado=             $conn->real_escape_string($_POST['resultado']);
$observaciones            = $conn->real_escape_string($_POST['observaciones']);

// justo después de include 'conexion.php';
file_put_contents('php://stderr', "POST recibidos: " . print_r($_POST, true));


$sql = "INSERT INTO reproduccion 
          (animal_id, fecha_mate, resultado, observaciones) 
        VALUES 
          ('$animal', '$fecha', '$resultado', '$observaciones')";

if ($conn->query($sql) === TRUE) {
    echo "Reproduccion guardado correctamente";
} else {
    echo "Error al guardar la reproduccion: " . $conn->error;
}

$conn->close();
?>
