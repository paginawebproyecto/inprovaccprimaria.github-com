<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Validar y asignar valores específicos para usuarios
    $grade = $_POST['grade'] ?? '';
    $id_number = $_POST['id_number'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';

    // Validar y asignar valores específicos para administradores
    $admin_code = $_POST['admin_code'] ?? '';
    $admin_department = $_POST['admin_department'] ?? '';

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "tienda_escolar";

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el nombre de usuario ya existe
    $sql = "SELECT * FROM usuarios WHERE name='$name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<script>alert('El nombre de usuario ya existe');</script>";
    } else {
        // Validar código y municipio solo si el rol es 'admin'
        if ($role === 'admin') {
            if (trim($admin_code) !== '123456' || trim($admin_department) !== 'inprovacc') {
                echo "<script>alert('Código de administrador o municipio incorrecto. Registro denegado.'); window.history.back();</script>";
                exit(); // Detener el proceso de registro si no es correcto
            }
        }

        // Hash de la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (name, password, role, grade, id_number, phone, email, admin_code, admin_department)
                VALUES ('$name', '$hashed_password', '$role', '$grade', '$id_number', '$phone', '$email', '$admin_code', '$admin_department')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Registro exitoso'); window.location.href='login.html';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
