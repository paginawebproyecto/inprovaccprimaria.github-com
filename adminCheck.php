<?php
session_start();
header('Content-Type: application/json');

// Verificar si el usuario está logueado como administrador
function isAdmin() {
    return isset($_SESSION['loggedin']) && $_SESSION['role'] === 'admin';
}

echo json_encode(['isAdmin' => isAdmin()]);
?>
