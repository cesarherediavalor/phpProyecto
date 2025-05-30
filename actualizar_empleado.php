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
$campos = ['id','nombre','apellido','cargo','telefono'];
foreach ($campos as $c) {
    if (!isset($_POST[$c])) {
        http_response_code(400);
        echo json_encode(["error" => "Falta parámetro $c"]);
        exit;
    }
}

// Saneamos
$id     = intval($_POST['id']);
$nom    = $conn->real_escape_string($_POST['nombre']);
$apellido   = $conn->real_escape_string($_POST['apellido']);
$cargo  = $conn->real_escape_string($_POST['cargo']);
$telefono   = $conn->real_escape_string($_POST['telefono']);

// Ejecutamos UPDATE
$sql = "UPDATE empleados
        SET nombre='$nom',
            apellido='$apellido',
            cargo='$cargo',
            telefono='$telefono'
        WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    if ($conn->affected_rows > 0) {
        echo json_encode(["message" => "OK"]);
    } else {
        http_response_code(404);
        echo json_encode(["error" => "No se encontró el empleado con ID $id"]);
    }
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error SQL: " . $conn->error]);
}

$conn->close();
?>
