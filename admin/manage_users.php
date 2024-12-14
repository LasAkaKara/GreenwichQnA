<?php
session_start();
$currentPage = 'manage_users';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: ../login.php');
    exit();
}

try {
    include 'includes/DatabaseConnector.php';
    include 'includes/DatabaseFunctions.php';

    // Get all users
    $sql = 'SELECT user_id, username, isAdmin FROM users ORDER BY username';
    $users = query($pdo, $sql)->fetchAll();

    $title = 'Manage Users';
    ob_start();
    include 'templates\manage_users.html.php';
    $output = ob_get_clean();

} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php';
?>