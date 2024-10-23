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

// Obtener productos de la base de datos
$result = $conn->query("SELECT * FROM productos");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Productos Disponibles</title>
    <link rel="stylesheet" href="menu.css" />
</head>
<body>
    <header>
        <h1>Productos Disponibles</h1>
        <nav>
            <a href="admin.php">Administración</a>
        </nav>
    </header>
    
    <main>
        <h2>Lista de Productos</h2>
        <div id="product-list">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="product-item">';
                    echo '<h2>' . htmlspecialchars($row['nombre']) . '</h2>';
                    echo '<p class="price">$' . htmlspecialchars($row['precio']) . '</p>';
                    echo '<p>Inventario: ' . htmlspecialchars($row['inventario']) . '</p>';
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
