<?php
header('Content-Type: application/json');

$servername = "localhost"; // Cambia esto si es necesario
$username = "root"; // Cambia esto por tu usuario
$password = ""; // Cambia esto por tu contraseña
$dbname = "tienda_escolar"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los pedidos de la tabla 'pedidos'
$sql = "SELECT * FROM pedidos"; 
$result = $conn->query($sql);

$pedidos = [];

if ($result->num_rows > 0) {
    // Recorrer los resultados y almacenarlos en un array
    while($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
}

$conn->close();

// Devolver los pedidos en formato JSON
echo json_encode($pedidos);
?>
