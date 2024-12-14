<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    include 'includes/DatabaseConnector.php';
    include 'includes/DatabaseFunctions.php';
    // Set current page to profile for the navigation bar
    $currentPage = 'profile';
    
    // Fetch user data
    $sql = 'SELECT user_id, username, email, profile_picture FROM users 
            WHERE user_id = :id AND isDeleted = 0';
    $user = query($pdo, $sql, ['id' => $_SESSION['user_id']])->fetch();

    $title = 'My Profile';
    
    ob_start();
    include 'templates/profile.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php'; 