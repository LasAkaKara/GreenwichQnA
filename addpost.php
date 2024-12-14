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

    if (isset($_POST['submit'])) {
        // Validate inputs
        if (empty($_POST['title']) || empty($_POST['post_content']) || empty($_POST['module']) || empty($_FILES['image_path'])) {
            throw new Exception('All fields are required');
        }
        
        // Insert the new post
        $sql = 'INSERT INTO posts (title, post_content, author, module, image_path) 
                VALUES (:title, :content, :author, :module, :image_path)';
        // Set upload type to posts to access posts folder
        $upload_type = 'posts';
        include 'actions\upload.php';
        // Insert the new post
        query($pdo, $sql, [
            'title' => $_POST['title'],
            'content' => $_POST['post_content'],
            'author' => $_SESSION['user_id'],
            'module' => $_POST['module'],
            'image_path' => $target_file
        ]);
        
        // Redirect to the new post
        header('Location: feed.php');
        exit();
    } else {
        // Get modules for the dropdown
        $sql = 'SELECT module_id, module_name FROM modules WHERE isDeleted = 0 ORDER BY module_name';
        $modules = query($pdo, $sql)->fetchAll();

        $title = 'Ask a Question';
        
        // Display the form
        ob_start();
        include 'templates\addpost.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error occurred';
    $output = $e->getMessage();
}

include 'templates/layout.html.php';