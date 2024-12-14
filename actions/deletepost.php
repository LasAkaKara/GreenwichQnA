<?php
session_start();
try{
    include '..\includes\DatabaseConnector.php';
    include '..\includes\DatabaseFunctions.php';
    // Delete the post
    deletePost($pdo, $_POST['post_id']);
    // Redirect to the feed page
    header("location:../feed.php");
} catch(PDOException $e){
    $title = "An error occured";
    $output = $e->getMessage();
}
?>