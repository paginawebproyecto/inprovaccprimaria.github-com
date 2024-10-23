<?php
$conn = new mysqli('localhost', 'root', '', 'tienda_escolar');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los productos
$sql = "SELECT id, nombre AS name, precio AS price, inventario AS inventory, imagen AS image FROM productos";
$result = $conn->query($sql);

$products = [];
while($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// Retornar los productos en formato JSON
header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>
