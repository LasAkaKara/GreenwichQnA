<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

try {
    include 'includes/DatabaseConnector.php';
    include 'includes/DatabaseFunctions.php';

    // Set current page to light up navigation
    $currentPage = 'profile';
    
    // Fetch user data for the current user
    $sql = 'SELECT user_id, username, email, profile_picture FROM users 
            WHERE user_id = :id AND isDeleted = 0';
    $user = query($pdo, $sql, ['id' => $_SESSION['user_id']])->fetch();

    // Check if user exists
    if (!$user) {
        throw new Exception('User not found');
    }

    $title = 'My Profile';
    
    // Load profile template
    ob_start();
    include 'templates/profile.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
} catch (Exception $e) {
    $title = 'Error';
    $output = $e->getMessage();
}

// Include main layout
include 'templates/layout.html.php';
?> 