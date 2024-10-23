<?php
session_start();
header('Content-Type: application/json');

$response = array('loggedin' => false, 'role' => '');

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $response['loggedin'] = true;
    $response['role'] = $_SESSION['role'];
}

echo json_encode($response);
?>
