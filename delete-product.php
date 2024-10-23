<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'tienda_escolar');

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el nombre del producto fue enviado
if (isset($_POST['productName'])) {
    $productName = $conn->real_escape_string($_POST['productName']);

    // SQL para eliminar el producto por nombre
    $sql = "DELETE FROM productos WHERE nombre = '$productName'";

    if ($conn->query($sql) === TRUE) {
        echo "Producto eliminado correctamente de la base de datos.";
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
} else {
    echo "No se proporcionó el nombre del producto para eliminar.";
}

$conn->close();
?>
