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
    // If the user_id is set, update the user to be an admin
    if (isset($_POST['user_id'])) {
        $parameters = [':user_id' => $_POST['user_id']];
        query($pdo, 'UPDATE users SET isAdmin = 1 WHERE user_id = :user_id', $parameters);
    }
    // Redirect to manage_users page
    header('Location: ../manage_users.php');
    exit();
    
} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
} 