<?php
session_start();

try{
    include '..\includes\DatabaseFunctions.php';
    include '..\includes\DatabaseConnector.php';

    // Insert the new answer
    $sql = 'INSERT INTO answers (post, author, answer_content) VALUES (:post_id, :author, :answer_content)';
    query($pdo, $sql, [
        'post_id' => $_POST['post_id'],
        'author' => $_SESSION['user_id'],
        'answer_content' => $_POST['answer_content']
    ]);
    // Redirect to the post page
    header('Location: ..\post.php?id='.$_POST['post_id']);
}catch(PDOException $e){
    $error = 'An error has occured: '.$e->getMessage();
}
?>