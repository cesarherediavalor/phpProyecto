<?php
include 'conexion.php';

// Sólo aceptamos POST y todos los campos
if ($_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['nombre'], $_POST['raza'], $_POST['fecha_nacimiento'],
            $_POST['sexo'], $_POST['peso'], $_POST['estado_salud'])) {
    http_response_code(400);
    exit('Faltan parámetros o método no permitido');
}

// Escapamos y saneamos
$nombre          = $conn->real_escape_string($_POST['nombre']);
$raza            = $conn->real_escape_string($_POST['raza']);
$fecha_nacimiento= $conn->real_escape_string($_POST['fecha_nacimiento']);
$sexo            = $conn->real_escape_string($_POST['sexo']);
$peso            = floatval($_POST['peso']);            // convierte a número
$estado_salud    = $conn->real_escape_string($_POST['estado_salud']);

$sql = "INSERT INTO animales 
          (nombre, raza, fecha_nacimiento, sexo, peso, estado_salud) 
        VALUES 
          ('$nombre', '$raza', '$fecha_nacimiento', '$sexo', $peso, '$estado_salud')";

if ($conn->query($sql) === TRUE) {
    echo "Animal guardado correctamente";
} else {
    echo "Error al guardar el animal: " . $conn->error;
}

$conn->close();
?>
