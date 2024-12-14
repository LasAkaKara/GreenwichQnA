<?php
session_start();
try{
    include '..\includes\DatabaseConnector.php';
    include '..\includes\DatabaseFunctions.php';

    //Soft delete post
    deletePost($pdo, $_POST['post_id']);
    //Redirect to feed after successful deletion
    header("location:../feed.php");
} catch(PDOException $e){
    $title = "An error occured";
    $output = $e->getMessage();
}
?>