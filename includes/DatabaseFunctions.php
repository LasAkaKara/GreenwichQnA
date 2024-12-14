<?php
function query($pdo, $sql, $parameters=[]){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}
function getPost($pdo, $id){
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM posts WHERE post_id = :id', $parameters);
    return $query->fetch();
}

function updatePost($pdo, $id, $post_content, $title, $image_path){
    $parameters = [':id'=>$id,':post_content'=>$post_content, ':title'=>$title, ':image_path'=>$image_path];
    query($pdo, 'UPDATE posts SET post_content = :post_content, title = :title, image_path = :image_path WHERE post_id = :id', $parameters);
}

function updateAnswer($pdo, $id, $answer_content, $title){
    $parameters = [':id'=>$id,':answer_content'=>$answer_content, ':title'=>$title];
    query($pdo, 'UPDATE answers SET answer_content = :answer_content, title = :title WHERE post_id = :id', $parameters);
}
function deletePost($pdo, $id){
    $parameters = [':id'=>$id];
    query($pdo, 'UPDATE posts SET isDeleted = 1 WHERE post_id = :id', $parameters);
}
?>