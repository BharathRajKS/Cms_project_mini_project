<?php
require('../config.php');
require('../model/DB.php'); 

$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $postId = intval($_POST['id']); 

        $stmt = $conn->prepare("DELETE FROM Cms_Post_table WHERE id = ?");
        $stmt->bind_param("i", $postId);

        if ($stmt->execute()) {
   
            echo json_encode(['success' => true, 'message' => 'Post deleted successfully!']);
        } else {
    
            echo json_encode(['success' => false, 'message' => 'Error deleting post: ' . $stmt->error]);
        }

        $stmt->close(); 
    } else {
     
        echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    }
} else {

    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}


$conn->close();
?>
