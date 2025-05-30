<?php
include 'conexion.php';

// Solo aceptamos POST para eliminación
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(["message" => "Método no permitido"]);
    exit;
}

// Validar que llegue el ID
if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    http_response_code(400);
    echo json_encode(["message" => "ID no válido o faltante"]);
    exit;
}

$id = intval($_POST['id']);

// Preparar y ejecutar DELETE
$sql = "DELETE FROM reproduccion WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Reproducción eliminada con éxito."]);
} else {
    http_response_code(500);
    echo json_encode(["message" => "Error al eliminar: " . $conn->error]);
}

$conn->close();
