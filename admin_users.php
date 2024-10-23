<?php
// Iniciar la sesión y verificar si el usuario está logueado como administrador
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda_escolar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener todos los usuarios
$sql = "SELECT id, name, role, grade, id_number, phone, email, admin_code, admin_department FROM usuarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
            <nav>
                <a href="index.html">Inicio</a>
                <a href="menu.html">Productos</a>
                <a href="admin-pedidos.php">Ver Pedidos</a>
                <a href="contacto.html">Contactanos</a>
                <div id="admin-options" style="display: none;">
                    <a href="admin.html" id="admin-link">Administrar</a>
                    <a href="admin-pedidos.php" id="view-orders-link">Ver Pedidos</a>
                    <a href="admin_users.php">Ver Usuarios Registrados</a>
    
                </div>
            </nav>
    <link rel="stylesheet" href="admin-users.css"> <!-- Aquí puedes agregar tus estilos CSS -->
</head>
<body>
    <div class="container">
        <h2>Usuarios Registrados</h2>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Rol</th>
                    <th>Grado</th>
                    <th>Identificación</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Código de Admin</th>
                    <th>Municipio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Comprobar si hay resultados
                if ($result->num_rows > 0) {
                    // Mostrar los usuarios en la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["role"] . "</td>";
                        echo "<td>" . ($row["role"] === "user" ? $row["grade"] : "-") . "</td>";
                        echo "<td>" . ($row["role"] === "user" ? $row["id_number"] : "-") . "</td>";
                        echo "<td>" . $row["phone"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . ($row["role"] === "admin" ? $row["admin_code"] : "-") . "</td>";
                        echo "<td>" . ($row["role"] === "admin" ? $row["admin_department"] : "-") . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No se encontraron usuarios.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>
