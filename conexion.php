<?php

$servername = "localhost"; // Cambia esto según tu configuración
$username = "root"; // Cambia esto por tu usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$dbname = "controlganado"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida - ERROR de conexión: " . $conn->connect_error);
}

//echo "Conexión exitosa";

// Cerrar la conexión cuando ya no se necesite
//$conn->close();

?>
