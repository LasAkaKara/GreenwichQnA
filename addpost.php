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

    // Handle form submission
    if (isset($_POST['submit'])) {
        // Validate required fields
        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['module'])) {
            throw new Exception('All fields are required');
        }

        // Handle image upload if present
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            // Validate image type
            $allowed = ['jpg', 'jpeg', 'png'];
            $filename = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (!in_array($ext, $allowed)) {
                throw new Exception('Invalid file type. Only JPG, JPEG and PNG are allowed.');
            }

            // Generate unique filename and move file
            $newName = uniqid() . '.' . $ext;
            $destination = 'uploads/' . $newName;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
                $imagePath = $destination;
            }
        }

        // Insert new post into database
        $sql = 'INSERT INTO posts (title, post_content, author, module, image_path) 
                VALUES (:title, :content, :author, :module, :image)';
        
        query($pdo, $sql, [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'author' => $_SESSION['user_id'],
            'module' => $_POST['module'],
            'image' => $imagePath
        ]);

        // Redirect to feed after successful post
        header('Location: feed.php');
        exit();
    }

    // Get list of modules for dropdown
    $sql = 'SELECT * FROM modules WHERE isDeleted = 0';
    $modules = query($pdo, $sql);

    $title = 'Ask a Question';
    $currentPage = 'addpost';
    
    // Load add post template
    ob_start();
    include 'templates\addpost.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'Error';
    $output = $e->getMessage();
}

// Include main layout
include 'templates\layout.html.php';
?>