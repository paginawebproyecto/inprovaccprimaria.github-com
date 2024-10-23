<?php
// update_inventory.php

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'tienda_escolar');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del pedido
$productName = $conn->real_escape_string($_POST['productName']);
$quantityOrdered = (int)$_POST['quantityOrdered'];

// Actualizar el inventario
$sql = "UPDATE productos SET inventario = inventario - $quantityOrdered WHERE nombre = '$productName'";

if ($conn->query($sql) === TRUE) {
    echo "Inventario actualizado correctamente.<br>";
} else {
    echo "Error al actualizar el inventario: " . $conn->error;
}

$conn->close();
?>
