<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: ../../login.php');
    exit();
}

try {
    include '../includes/DatabaseConnector.php';
    include '../includes/DatabaseFunctions.php';

    if (isset($_POST['user_id'])) {
        // Delete user's content first (posts, answers, comments)
        $parameters = [':user_id' => $_POST['user_id']];
        
        // Finally delete the user
        query($pdo, 'DELETE FROM users WHERE user_id = :user_id', $parameters);
    }
    
    header('Location: ../manage_users.php');
    exit();
    
} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
} 