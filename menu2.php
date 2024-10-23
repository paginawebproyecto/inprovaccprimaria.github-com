<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tienda</title>
    <link rel="stylesheet" href="menu.css" />
    <link rel="stylesheet" href="cssextraajavalenojoda.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-content">
            <h1>Productos</h1>
            <nav>
                <a href="index.html">Inicio</a>     
                <a href="menu.html">Productos</a>
                <a href="pagina-de-pedido.html">Carrito</a>
                <a href="contacto.html">Contáctanos</a>
                <div id="admin-options" style="display: none;">
                    <a href="admin.html" id="admin-link">Administrar</a>
                    <a href="admin-pedidos.html" id="view-orders-link">Ver Pedidos</a>
                </div>
            </nav>
            <div class="cart-icon-container">
                <i id="toggle-cart" class="fas fa-shopping-cart"></i>
                <span id="cart-count">0</span>
            </div>
        </div>
    </header>

    <aside id="cart" class="closed">
        <h2>Carrito</h2>
        <ul id="cart-items"></ul>
        <p id="total-price">Total: $0</p>
    </aside>

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
$result = $conn->query("SELECT * FROM productos");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-item">';
                    echo '<h2>' . htmlspecialchars($row['nombre']) . '</h2>';
                    echo '<p class="price">$' . htmlspecialchars($row['precio']) . '</p>';
                    echo '<p>Inventario: ' . htmlspecialchars($row['inventario']) . '</p>';
                    echo '<form action="delete_product.php" method="post">';
                    echo '<input type="hidden" name="productId" value="' . $row['id'] . '" />';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No hay productos disponibles.</p>';
            }
            ?>

    <script src="menu.js"></script>
    <script src="adminCheck.js"></script>
</body>
</html>