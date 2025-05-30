<?php
include 'conexion.php';

// Vamos a aceptar POST en lugar de DELETE
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    // Validar y sanitizar el ID
    if (!is_numeric($id)) {
        echo json_encode(["message" => "ID no válido."]);
        exit;
    }
    // Preparar la consulta SQL para eliminar el empleado
    $sql = "DELETE FROM empleados WHERE id = $id"; 
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Empleado eliminado con éxito."]);
    } else {
        echo json_encode(["message" => "Error al eliminar el empleado: " . $conn->error]);
    }
    $conn->close();
} else {
    echo json_encode(["message" => "Método no permitido."]);
}
?>
