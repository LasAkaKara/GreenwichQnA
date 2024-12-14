<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    include 'includes\DatabaseConnector.php';
    include 'includes\DatabaseFunctions.php';

    // Check if post ID is provided
    if (!isset($_GET['id'])) {
        throw new Exception('No post specified');
    }

    $currentPage = 'post';

    // Get post details with author info and counts
    $sql = 'SELECT posts.*, users.username as authorname,
            (SELECT COUNT(*) FROM answers WHERE post = posts.post_id AND isDeleted = 0) as answers_count,
            (SELECT COUNT(*) FROM likes WHERE post = posts.post_id AND isLike = 1) as like_count,
            (SELECT COUNT(*) FROM likes WHERE post = posts.post_id AND isLike = 0) as dislike_count,
            (SELECT isLike FROM likes WHERE post = posts.post_id AND user = :user_id) as user_like
            FROM posts 
            LEFT JOIN users ON posts.author = users.user_id
            WHERE post_id = :id AND posts.isDeleted = 0';

    $post = query($pdo, $sql, [
        'id' => $_GET['id'],
        'user_id' => $_SESSION['user_id']
    ])->fetch();

    // Check if post exists
    if (!$post) {
        throw new Exception('Post not found');
    }

    // Get answers for the post
    $sql = 'SELECT answers.*, users.username, 
            (SELECT COUNT(*) FROM likes WHERE post = answers.answer_id AND isLike = 1) as like_count,
            (SELECT COUNT(*) FROM likes WHERE post = answers.answer_id AND isLike = 0) as dislike_count,
            (SELECT isLike FROM likes WHERE post = answers.answer_id AND user = :user_id) as user_like
            FROM answers 
            LEFT JOIN users ON answers.author = users.user_id
            WHERE answers.post = :post_id AND answers.isDeleted = 0
            ORDER BY answers.time DESC';

    $answers = query($pdo, $sql, [
        'post_id' => $_GET['id'],
        'user_id' => $_SESSION['user_id']
    ]);

    $title = $post['title'];
    
    // Load post template
    ob_start();
    include 'templates\post.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error has occurred';
    $output = $e->getMessage();
}

// Include main layout
include 'templates\layout.html.php';
?>

