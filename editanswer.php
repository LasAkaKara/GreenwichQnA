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

    if(isset ($_POST['submit']) &&isset($_POST['answer_content']) && isset($_POST['title'])){
        updateAnswer($pdo, $_POST['answer_id'], $_POST['answer_content'], $_POST['title']);
        header('location: post.php?id='.$_POST['post_id']);
        exit();
    }
    else{
        $parameters = [':id' => $_GET['id']];
        $answer = query($pdo, 'SELECT * FROM answers WHERE answer_id = :id', $parameters) ->fetch();

        $title= 'Edit Answer';
        ob_start();
        include 'templates\editanswer.html.php';
        $output= ob_get_clean();
    }
}catch(PDOException $e){
    $title = "An error occured.";
    $output = $e->getMessage();
}
include 'templates\layout.html.php';