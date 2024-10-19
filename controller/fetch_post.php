



<?php
require('../config.php');
require('../model/DB.php');


$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $postId = intval($_GET['id']);

    $query = "SELECT id, title, short_description, content, image FROM Cms_Post_table WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $postId);
        $stmt->execute();

        $result = $stmt->get_result();
        $post = $result->fetch_assoc();
        $stmt->close();

        if ($post) {
       
            $imagePath = '../uploads/' . $post['image'];
            if (!file_exists($imagePath) || empty($post['image'])) {
                $post['image'] = 'default-image.jpg';
            }

            echo json_encode($post);
        } else {
            echo json_encode(['error' => 'Post not found']);
        }
    } else {
        echo json_encode(['error' => 'Failed to prepare the statement']);
    }
} else {
    echo json_encode(['error' => 'Invalid request. No valid post ID provided.']);
}

$conn->close();


?>
