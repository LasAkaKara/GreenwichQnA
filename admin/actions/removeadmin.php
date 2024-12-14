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
    //Update user's isAdmin status to 0
    if (isset($_POST['user_id'])) {
        $parameters = [':user_id' => $_POST['user_id']];
        query($pdo, 'UPDATE users SET isAdmin = 0 WHERE user_id = :user_id', $parameters);
    }
    
    //Redirect to manage users after successful update
    header('Location: ../manage_users.php');
    exit();
    
} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
} 