<?php
session_start();

try{
    include '..\includes\DatabaseFunctions.php';
    include '..\includes\DatabaseConnector.php';

    //Insert new comment into database
    $sql = 'INSERT INTO comments (answer, author, comment_content) VALUES (:answer_id, :author, :comment_content)';
    query($pdo, $sql, [
        'answer_id' => $_POST['answer_id'],
        'author' => $_SESSION['user_id'],
        'comment_content' => $_POST['comment_content']
    ]);
    //Redirect to post after successful comment
    header('Location: ..\post.php?id='.$_POST['post_id']);
}catch(PDOException $e){
    $error = 'An error has occured: '.$e->getMessage();
}
?>