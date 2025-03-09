<?php
session_start();
require 'config.php'; // Database connection

$query = "SELECT videos.id, videos.video_path, videos.title, users.username, 
          (SELECT COUNT(*) FROM likes WHERE likes.video_id = videos.id) AS like_count 
          FROM videos JOIN users ON videos.user_id = users.id ORDER BY videos.created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Video Feed</title>
    <style>
        .video-container { margin-bottom: 20px; text-align: center; }
        video { width: 100%; max-width: 600px; display: block; margin: 0 auto; }
        .like-btn, .comment-btn, .share-btn {
            cursor: pointer; margin: 5px; padding: 5px 10px; border: none;
            background-color: #ff3b5c; color: white; border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="video-container" data-video-id="<?php echo $row['id']; ?>">
            <h3><?php echo htmlspecialchars($row['username']); ?></h3>
            <video class="video-player" muted>
                <source src="<?php echo htmlspecialchars($row['video_path']); ?>" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <p><?php echo htmlspecialchars($row['title']); ?></p>
            <button class="like-btn" onclick="likeVideo(<?php echo $row['id']; ?>)">❤ Like (<span id="like-count-<?php echo $row['id']; ?>"><?php echo $row['like_count']; ?></span>)</button>
            <button class="comment-btn" onclick="toggleComments(<?php echo $row['id']; ?>)">💬 Comment</button>
            <button class="share-btn" onclick="shareVideo('<?php echo htmlspecialchars($row['video_path']); ?>')">📤 Share</button>
            <div class="comments-section" id="comments-<?php echo $row['id']; ?>" style="display: none;">
                <input type="text" id="comment-input-<?php echo $row['id']; ?>" placeholder="Write a comment...">
                <button onclick="postComment(<?php echo $row['id']; ?>)">Post</button>
                <div id="comment-list-<?php echo $row['id']; ?>"></div>
            </div>
        </div>
    <?php endwhile; ?>
</body>
</html>