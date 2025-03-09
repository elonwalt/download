<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['video_id'], $_POST['comment'])) {
    $video_id = intval($_POST['video_id']);
    $user_id = $_SESSION['user_id'] ?? 0; 
    $comment = htmlspecialchars(trim($_POST['comment']));

    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (user_id, video_id, comment_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $video_id, $comment);
        $stmt->execute();
        echo $comment;
    }
}
?>