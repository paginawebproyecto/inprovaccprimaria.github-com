<?php
// Conexión a la base de datos (reemplaza los valores con tus credenciales de base de datos)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión es exitosa
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = isset($_POST['phone']) ? $conn->real_escape_string($_POST['phone']) : 'No proporcionado';
    $message = $conn->real_escape_string($_POST['message']);

    // Insertar los datos en la tabla de contacto
    $sql = "INSERT INTO contacto (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Redirigir a una página de confirmación
        header("Location: confirmacion.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
