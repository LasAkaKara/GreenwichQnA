<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try{
    include 'includes\DatabaseConnector.php';
    include 'includes\DatabaseFunctions.php';
    // If the form is submitted, update the post
    if(isset ($_POST['submit']) &&isset($_POST['post_content']) && isset($_POST['title'])){
        // Set upload type to posts to access posts folder
        $upload_type = 'posts';
        include 'actions\upload.php';
        // Update the post
        updatePost($pdo, $_POST['post_id'], $_POST['post_content'], $_POST['title'], $target_file);
        // Redirect to feed page
        header('location: feed.php');
        exit();
    }
    else{
        $posts = getPost($pdo, $_GET['id']);

        $title= 'Edit Post';
        ob_start();
        include 'templates\editpost.html.php';
        $output= ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error occured.";
    $output = $e->getMessage();
}
include 'templates\layout.html.php';