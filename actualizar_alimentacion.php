<?php
// Permitir CORS y JSON
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include 'conexion.php';

// Solo permitir POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["error" => "Método no permitido"]);
    exit;
}

// Campos esperados
$campos = ['id','animal_id','fecha','tipo_alimento','cantidad'];
foreach ($campos as $c) {
    if (!isset($_POST[$c])) {
        http_response_code(400);
        echo json_encode(["error" => "Falta parámetro $c"]);
        exit;
    }
}

// Saneamos y convertimos
$id            = intval($_POST['id']);
$animal_id     = intval($_POST['animal_id']);
$fecha_mate    = $conn->real_escape_string($_POST['fecha']);
$tipo     = $conn->real_escape_string($_POST['tipo_alimento']);
$cantidad = $conn->real_escape_string($_POST['cantidad']);

// Armamos y ejecutamos UPDATE
$sql = "UPDATE alimentacion
        SET animal_id    = $animal_id,
            fecha   = '$fecha_mate',
            tipo_alimento    = '$tipo',
            cantidad= '$cantidad'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
        echo json_encode(["message" => "Alimentacion actualizada exitosamente"]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "No se encontró registro con ID $id"]);
    }
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error SQL: " . $conn->error]);
}

$conn->close();
