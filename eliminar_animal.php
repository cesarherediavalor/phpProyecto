<?php
include 'conexion.php';

// Vamos a aceptar POST en lugar de DELETE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['animal_id'];
    // Validar y sanitizar el ID
    if (!is_numeric($id)) {
        echo json_encode(["message" => "ID no válido."]);
        exit;
    }
    // Preparar la consulta SQL para eliminar el animal
    $sql = "DELETE FROM animales WHERE animal_id = $id"; 
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Animal eliminado con éxito."]);
    } else {
        echo json_encode(["message" => "Error al eliminar el animal: " . $conn->error]);
    }
    $conn->close();
} else {
    echo json_encode(["message" => "Método no permitido."]);
}
?>
