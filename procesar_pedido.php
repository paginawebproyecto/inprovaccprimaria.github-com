<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root"; // Usuario por defecto en XAMPP
$password = ""; // Contraseña vacía por defecto en XAMPP
$dbname = "tienda_escolar"; // Asegúrate de que este sea el nombre correcto

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$grade = $_POST['grade'] ?? '';
$phone = $_POST['phone'] ?? '';
$cartItems = $_POST['cartItems'] ?? '[]'; // Asignar un valor por defecto si no existe

// Asegúrate de que cartItems sea un JSON válido
$cartItemsArray = json_decode($cartItems, true);
$cartItemsJson = json_encode($cartItemsArray); // Convertir el array a JSON antes de vincular

// Insertar el pedido en la base de datos
$sql = "INSERT INTO pedidos (nombre, email, grado, telefono, productos) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $name, $email, $grade, $phone, $cartItemsJson); // Usar la variable $cartItemsJson
if ($stmt->execute()) {
    header("Location: resumen-pedido.html");
    exit(); // Es importante incluir exit para asegurarse de que el script se detenga después de la redirección
} else {
    echo "Error al realizar el pedido: " . $stmt->error;
}


$stmt->close();
$conn->close();
?>
