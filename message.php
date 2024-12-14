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

    // Set current page to message for the navigation bar
    $currentPage = 'message';

    if (isset($_POST['submit'])) {
        // Validate inputs
        if (empty($_POST['title']) || empty($_POST['message_content'])) {
            throw new Exception('All fields are required');
        }
        
        // Insert the new message
        $sql = 'INSERT INTO admin_messages (user, title, message_content) 
                VALUES (:user, :title, :message_content)';

        query($pdo, $sql, [
            'user' => $_SESSION['user_id'],
            'title' => $_POST['title'],
            'message_content' => $_POST['message_content']
        ]);
        // Redirect to feed page
        header('Location: feed.php');
        exit();
    } else {
        $title = 'Contact An Admin';
        $currentPage = 'message';
        
        ob_start();
        include 'templates\message.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error occurred';
    $output = $e->getMessage();
}

include 'templates/layout.html.php'; 