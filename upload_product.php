<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'tienda_escolar');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$productName = $conn->real_escape_string($_POST['productName']);
$productPrice = $conn->real_escape_string($_POST['productPrice']);

// Insertar el producto en la base de datos
$sql = "INSERT INTO productos (nombre, precio) VALUES ('$productName', '$productPrice')";

if ($conn->query($sql) === TRUE) {
    echo "Producto agregado correctamente a la base de datos.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
