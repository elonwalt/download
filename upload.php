<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['video'])) {
    $user_id = $_SESSION['user_id'] ?? 0; 
    $title = htmlspecialchars($_POST['title']);
    $video = $_FILES['video'];
    $upload_dir = 'uploads/';
    
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $video_path = $upload_dir . basename($video['name']);
    
    if (move_uploaded_file($video['tmp_name'], $video_path)) {
        $stmt = $conn->prepare("INSERT INTO videos (user_id, video_path, title) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $video_path, $title);
        $stmt->execute();
        echo "Video uploaded successfully!";
    } else {
        echo "Upload failed!";
    }
}
?>