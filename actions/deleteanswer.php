<?php
session_start();
try{
    include '..\includes\DatabaseConnector.php';
    include '..\includes\DatabaseFunctions.php';

    //Soft delete answer
    $parameters = [':id'=>$_POST['answer_id']];
    query($pdo, 'UPDATE answers SET isDeleted = 1 WHERE answer_id = :id', $parameters);
    //Redirect to post after successful deletion
    header("location:../post.php?id=".$_POST['post_id']);
} catch(PDOException $e){
    $title = "An error occured";
    $output = $e->getMessage();
}
?>