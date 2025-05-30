<?php
// permitir CORS si lo necesitas
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'conexion.php';

// Solo permitimos POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    exit;
}

// Validamos que existan todos los campos en $_POST
$campos = ['animal_id','nombre','raza','fecha_nacimiento','sexo','peso','estado_salud'];
foreach ($campos as $c) {
    if (!isset($_POST[$c])) {
        http_response_code(400);
        echo json_encode(["error" => "Falta parámetro $c"]);
        exit;
    }
}

// Saneamos
$id     = intval($_POST['animal_id']);
$nom    = $conn->real_escape_string($_POST['nombre']);
$raza   = $conn->real_escape_string($_POST['raza']);
$fecha  = $conn->real_escape_string($_POST['fecha_nacimiento']);
$sexo   = $conn->real_escape_string($_POST['sexo']);
$peso   = floatval($_POST['peso']);
$salud  = $conn->real_escape_string($_POST['estado_salud']);

// Ejecutamos UPDATE
$sql = "UPDATE animales
        SET nombre='$nom',
            raza='$raza',
            fecha_nacimiento='$fecha',
            sexo='$sexo',
            peso=$peso,
            estado_salud='$salud'
        WHERE animal_id = $id";

if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
        echo json_encode(["message" => "OK"]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "No se encontró el animal con ID $id"]);
    }
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error SQL: " . $conn->error]);
}

$conn->close();
?>
