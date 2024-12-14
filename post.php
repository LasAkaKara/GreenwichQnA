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

    // Get post with author information
    $sql_post = 'SELECT posts.*, users.username as author_name,
    (SELECT COUNT(*) FROM likes WHERE post = posts.post_id AND isLike = 1) as like_count,
    (SELECT COUNT(*) FROM likes WHERE post = posts.post_id AND isLike = 0) as dislike_count,
    (SELECT isLike FROM likes WHERE post = posts.post_id AND user = :user_id) as user_like
    FROM posts JOIN users ON posts.author = users.user_id
    WHERE post_id = :post_id;';
    // Query to get post with author information
    $post = query($pdo, $sql_post, [
    'post_id' => $_GET['id'],
    'user_id' => $_SESSION['user_id']
    ])->fetch();

    // Get answers with author information and comment counts
    $sql_answers = 'SELECT answers.*, users.username as author_name,
                    (SELECT COUNT(*) FROM comments WHERE answer_id = answers.answer_id) as comment_count
                    FROM answers 
                    LEFT JOIN users ON answers.author = users.user_id 
                    WHERE post = ? AND answers.isDeleted = "0"
                    ORDER BY answers.time DESC';
    $answers = query($pdo, $sql_answers, [$_GET['id']])->fetchAll();

    // Get all comments for all answers
    $sql_comments = 'SELECT comments.*, users.username as author_name, answers.answer_id
                    FROM comments 
                    LEFT JOIN users ON comments.author = users.user_id
                    LEFT JOIN answers ON comments.answer = answers.answer_id
                    WHERE answers.post = ?
                    ORDER BY comments.time ASC';
    $comments = query($pdo, $sql_comments, [$_GET['id']])->fetchAll();

    // Organize comments by answer_id for easier access in template
    $comments_by_answer = [];
    foreach ($comments as $comment) {
        $answer_id = $comment['answer_id'];
        if (!isset($comments_by_answer[$answer_id])) {
            $comments_by_answer[$answer_id] = [];
        }
        $comments_by_answer[$answer_id][] = $comment;
    }
    
    $title = htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8');
    
    // Buffer the output
    ob_start();
    include 'templates\post.html.php';
    $output = ob_get_clean();
    
} catch(PDOException $e) {
    $title = 'An error has occurred';
    $output = $e->getMessage();
}

include 'templates\layout.html.php';
?>

