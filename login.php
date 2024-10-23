<?php
session_start();

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$db_password = ""; // Cambié el nombre de la variable para evitar conflicto con $password de usuario
$dbname = "tienda_escolar";

$conn = new mysqli($servername, $username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];

    // Usar una consulta preparada para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verificar la contraseña ingresada con el hash almacenado
        if (password_verify($password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['name'] = $row['name'];
            $_SESSION['role'] = $row['role'];

            // Redirigir según el rol
            if ($row['role'] == 'admin') {
                header("Location: admin.html"); // Página de administración
            } else {
                header("Location: index.html"); // Página de usuario
            }
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }

    $stmt->close();
}
$conn->close();
?>
