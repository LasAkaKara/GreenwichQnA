<?php
session_start();

// Check if user is logged in, redirect to login if not
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$currentPage = 'feed';
try {
    // Include necessary database files
    include 'includes\DatabaseConnector.php';
    include 'includes\DatabaseFunctions.php';

    // Get filter parameter from URL, default to 'newest'
    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
    } else {
        $filter = 'newest';
    }

    // Base SQL query to get posts with related information
    $sql_o = 'SELECT posts.post_id, posts.title, posts.post_content, posts.author, posts.module, posts.time, 
              users.username as authorname, 
              (SELECT COUNT(*) FROM answers WHERE answers.post = posts.post_id AND answers.isDeleted = "0") AS answers_count, 
              (SELECT COUNT(*) FROM likes WHERE likes.post = posts.post_id AND likes.isLike = 1) AS like_count,
              (SELECT COUNT(*) FROM likes WHERE likes.post = posts.post_id AND likes.isLike = 0) AS dislike_count
              FROM posts
              LEFT JOIN users ON posts.author = users.user_id
              LEFT JOIN answers ON posts.post_id = answers.post 
              LEFT JOIN likes ON posts.post_id = likes.post
              WHERE posts.isDeleted = "0"
              GROUP BY posts.post_id';

    // Apply different sorting based on filter selection
    switch($filter){
        case 'newest':
            $sql = $sql_o . 'ORDER BY posts.time DESC;';
            break;
        case 'most_answered':
            $sql = $sql_o .'ORDER BY answers_count DESC;';
            break;
        case 'unanswered':
            $sql = $sql_o .'HAVING answers_count = 0;';
            break;
    }

    // Execute query and get posts
    $posts = query($pdo,$sql);
    $title = 'Feed';
    
    // Load the feed template
    ob_start();
    include 'templates\feed.html.php';
    $output = ob_get_clean();

} catch(PDOException $e) {
    $title = 'An error has occurred';
    $output = $e->getMessage();
}

// Include the main layout template
include 'templates\layout.html.php';
?>