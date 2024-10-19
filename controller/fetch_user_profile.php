<?php
session_start();
header('Content-Type: application/json');

$response = [];

if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    $response['name'] = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
    $response['is_admin'] = isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : true; 
} else {
    $response['error'] = 'User not logged in';
}

echo json_encode($response);
?>
