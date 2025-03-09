<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['video_id'])) {
    $video_id = intval($_POST['video_id']);
    $user_id = $_SESSION['user_id'] ?? 0; 

    $check_like = $conn->prepare("SELECT id FROM likes WHERE user_id = ? AND video_id = ?");
    $check_like->bind_param("ii", $user_id, $video_id);
    $check_like->execute();
    $result = $check_like->get_result();

    if ($result->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO likes (user_id, video_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $video_id);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND video_id = ?");
        $stmt->bind_param("ii", $user_id, $video_id);
        $stmt->execute();
    }

    $count_query = $conn->prepare("SELECT COUNT(*) FROM likes WHERE video_id = ?");
    $count_query->bind_param("i", $video_id);
    $count_query->execute();
    $count_query->bind_result($like_count);
    $count_query->fetch();
    echo $like_count;
}
?>