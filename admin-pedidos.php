<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda_escolar";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Eliminar pedido si se ha enviado una solicitud POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Preparar y ejecutar la consulta de eliminación
    $sql = "DELETE FROM pedidos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>alert('Pedido eliminado correctamente');</script>";
    } else {
        echo "<script>alert('Error al eliminar el pedido');</script>";
    }

    // Recargar la página para actualizar la lista de pedidos
    echo "<script>window.location.href = window.location.href;</script>";
}

// Seleccionar los pedidos desde la tabla 'pedidos'
$sql = "SELECT id, nombre, email, grado, telefono, productos FROM pedidos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Pedidos</title>
    <style>
        /* Estilos anteriores */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-content h1 {
            margin: 0;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            margin-top: 60px; /* Ajusta según la altura de tu header */
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #333;
            color: #fff;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Botón para eliminar */
        .delete-button {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .delete-button:hover {
            background-color: #ff1a1a;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
        }

    </style>
</head>
<body>

<header>
    <div class="header-content">
        <h1>Pedidos Administrador</h1>
        <nav>
            <a href="index.html">Inicio</a>
            <a href="Menu.html">Productos</a>
            <a href="pagina-de-pedido.html">Carrito</a>
            <a href="contacto.html">Contáctanos</a>
            <div id="admin-options" style="display: none;">
                <a href="admin.html" id="admin-link">Administrar</a>
                <a href="admin-pedidos.php" id="view-orders-link">Ver Pedidos</a>
                <a href="admin_users.php">Ver Usuarios Registrados</a>

            </div>
        </nav>
</header>

<main>
    <h2>Lista de Pedidos</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Grado</th>
            <th>Teléfono</th>
            <th>Productos</th>
            <th>Eliminar</th> <!-- Nueva columna para el botón de eliminar -->
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Mostrar datos de cada fila
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"]. "</td>
                        <td>" . $row["nombre"]. "</td>
                        <td>" . $row["email"]. "</td>
                        <td>" . $row["grado"]. "</td>
                        <td>" . $row["telefono"]. "</td>
                        <td>" . $row["productos"]. "</td>
                        <td>
                            <form method='POST' action=''>
                                <input type='hidden' name='delete_id' value='" . $row["id"] . "'>
                                <button type='submit' class='delete-button'>Eliminar</button>
                            </form>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No hay pedidos</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</main>

<footer>
    &copy; 2024 Tienda Escolar - Todos los derechos reservados.
</footer>

</body>
</html>
