<?php
session_start();
require_once("../model/DB.php");
$config = require('../config.php');

$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "SELECT * FROM Cms_Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $row = $result->fetch_assoc();
        $storedPasswordHash = $row['password_hash'];
        if (password_verify($password, $storedPasswordHash)) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['is_admin'] = $row['role_id']; 
            $_SESSION['email'] = $row['email'];

            if ($row['role_id'] == 1) { 
                $_SESSION['is_admin'] = true; 
            } 
            else {
                $_SESSION['is_admin'] = false; 
            }

            echo json_encode([
                'status' => 'success',
                'role' => $_SESSION['is_admin'] ? 'admin' : 'user', 
                'message' => 'Login successful'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid credentials'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input data'
    ]);
}

$conn->close();
?>
