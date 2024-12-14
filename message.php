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

    // Handle message submission
    if (isset($_POST['submit'])) {
        // Validate required fields
        if (empty($_POST['title']) || empty($_POST['message_content'])) {
            throw new Exception('All fields are required');
        }
        
        // Insert new message into database
        $sql = 'INSERT INTO admin_messages (user, title, message_content) 
                VALUES (:user, :title, :message_content)';

        query($pdo, $sql, [
            'user' => $_SESSION['user_id'],
            'title' => $_POST['title'],
            'message_content' => $_POST['message_content']
        ]);
        
        // Redirect to feed after successful message send
        header('Location: feed.php');
        exit();
    }

    $title = 'Contact An Admin';
    $currentPage = 'message';
    
    // Load message form template
    ob_start();
    include 'templates\message.html.php';
    $output = ob_get_clean();

} catch (Exception $e) {
    $title = 'An error occurred';
    $output = $e->getMessage();
}

// Include main layout
include 'templates/layout.html.php';
?> 