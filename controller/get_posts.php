<?php
require('../config.php');
require('../model/DB.php');

$databaseConnection = new DatabaseConnection($config);
$conn = $databaseConnection->getConnection();

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6;

$offset = ($page - 1) * $limit;

$query = "SELECT * FROM Cms_Post_table LIMIT $limit OFFSET $offset";
$result = $conn->query($query);

$posts = [];
while ($row = $result->fetch_assoc()) {
    $posts[] = $row;
}

$totalQuery = "SELECT COUNT(*) as total FROM Cms_Post_table";
$totalResult = $conn->query($totalQuery);
$totalPosts = $totalResult->fetch_assoc()['total'];

echo json_encode([
    'success' => true,
    'posts' => $posts,
    'totalPosts' => $totalPosts,
]);

$conn->close();
