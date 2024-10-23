<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'tienda_escolar');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener productos de la base de datos
$result = $conn->query("SELECT * FROM productos");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="product-item">';
        echo '<h2>' . htmlspecialchars($row['nombre']) . '</h2>';
        echo '<p class="price">$' . htmlspecialchars($row['precio']) . '</p>';
        echo '<p>Inventario: ' . htmlspecialchars($row['inventario']) . '</p>';
        echo '<form action="delete_product.php" method="post">';
        echo '<input type="hidden" name="productId" value="' . $row['id'] . '" />';
        echo '<button type="submit">Eliminar Producto</button>';
        echo '</form>';
        echo '</div>';
    }
} else {
    echo '<p>No hay productos disponibles.</p>';
}

// Cerrar conexión
$conn->close();
?>
