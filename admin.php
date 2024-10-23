<?php
// Habilitar visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'tienda_escolar');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Si se envía el formulario para agregar un producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productName'])) {
    // Obtener datos del formulario
    $productName = $conn->real_escape_string($_POST['productName']);
    $productPrice = $conn->real_escape_string($_POST['productPrice']);
    $inventoryAmount = $conn->real_escape_string($_POST['inventoryAmount']);
    
    // Insertar el producto en la base de datos
    $sql = "INSERT INTO productos (nombre, precio, inventario) VALUES ('$productName', '$productPrice', '$inventoryAmount')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Producto agregado correctamente.</p>";
    } else {
        echo "<p>Error al agregar el producto: " . $conn->error . "</p>";
    }
}

// Obtener productos de la base de datos
$result = $conn->query("SELECT * FROM productos");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administración - Productos</title>
    <link rel="stylesheet" href="menu.css" />
</head>
<body>
    <header>
        <h1>Administración de Productos</h1>
        <nav>
            <a href="index.html">Inicio</a>
        </nav>
    </header>
    
    <main>
        <!-- Formulario para agregar productos -->
        <form action="" method="post">
            <div>
                <label for="productName">Nombre del Producto:</label>
                <input type="text" name="productName" id="productName" required />
            </div>
            <div>
                <label for="productPrice">Precio:</label>
                <input type="number" name="productPrice" id="productPrice" required />
            </div>
            <div>
                <label for="inventoryAmount">Inventario:</label>
                <input type="number" name="inventoryAmount" id="inventoryAmount" required />
            </div>
            <button type="submit">Agregar Producto</button>
        </form>

        <h2>Productos en Inventario</h2>
        <div id="product-list">
            <?php
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
            ?>
        </div>
    </main>

    <?php
    // Cerrar conexión
    $conn->close();
    ?>
</body>
</html>
