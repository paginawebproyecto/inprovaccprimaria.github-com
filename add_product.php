<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";  // Cambia si tienes una contraseña en tu base de datos
$dbname = "tienda_escolar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos fueron enviados
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Verificar si se ha subido una imagen
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";  // Carpeta donde se guardarán las imágenes
        $image_name = basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image_name;

        // Intentar subir la imagen al servidor
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insertar el producto en la base de datos
            $sql = "INSERT INTO productos (name, price, image_path) VALUES ('$name', '$price', '$target_file')";

            if ($conn->query($sql) === TRUE) {
                echo "Producto guardado correctamente.";
            } else {
                echo "Error al guardar el producto en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "No se subió ninguna imagen o hubo un error.";
    }
} else {
    echo "Método de solicitud no válido.";
}

$conn->close();
?>
