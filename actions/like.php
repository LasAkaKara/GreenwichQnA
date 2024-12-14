<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

try {
    include '../includes/DatabaseConnector.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['post_id']) && isset($_POST['action'])) {
        $post_id = $_POST['post_id'];
        $user_id = $_SESSION['user_id'];
        $action = $_POST['action']; // 'like' or 'dislike'

        // Check if user has already liked/disliked
        $sql = 'SELECT isLike FROM likes WHERE user = :user AND post = :post';
        $existing = query($pdo, $sql, [
            'user' => $user_id,
            'post' => $post_id
        ])->fetch();

        if ($existing) {
            // User has already interacted with this post
            if (($action === 'like' && $existing['isLike'] === 1) || 
                ($action === 'dislike' && $existing['isLike'] === 0)) {
                // Remove like/dislike if clicking the same button
                $sql = 'DELETE FROM likes WHERE user = :user AND post = :post';
                query($pdo, $sql, [
                    'user' => $user_id,
                    'post' => $post_id
                ]);
            } else {
                // Update existing interaction
                $sql = 'UPDATE likes SET isLike = :isLike WHERE user = :user AND post = :post';
                query($pdo, $sql, [
                    'isLike' => ($action === 'like' ? 1 : 0),
                    'user' => $user_id,
                    'post' => $post_id
                ]);
            }
        } else {
            // New interaction
            $sql = 'INSERT INTO likes (user, post, isLike) VALUES (:user, :post, :isLike)';
            query($pdo, $sql, [
                'user' => $user_id,
                'post' => $post_id,
                'isLike' => ($action === 'like' ? 1 : 0)
            ]);
        }

        // Get updated counts
        $sql = 'SELECT 
                (SELECT COUNT(*) FROM likes WHERE post = :post AND isLike = 1) as likes,
                (SELECT COUNT(*) FROM likes WHERE post = :post AND isLike = 0) as dislikes';
        $counts = query($pdo, $sql, ['post' => $post_id])->fetch();

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'likes' => $counts['likes'],
            'dislikes' => $counts['dislikes']
        ]);
        exit();
    }
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
} 