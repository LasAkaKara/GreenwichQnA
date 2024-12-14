<?php
session_start();
$currentPage = 'messages';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: ../login.php');
    exit();
}

try {
    include 'includes/DatabaseConnector.php';
    include 'includes/DatabaseFunctions.php';

    // Get all messages with user information
    $sql = 'SELECT admin_messages.*, users.username 
            FROM admin_messages 
            LEFT JOIN users ON admin_messages.user = users.user_id 
            ORDER BY admin_messages.time DESC';
    //Fetch all messages
    $messages = query($pdo, $sql)->fetchAll();

    $title = 'Admin Messages';
    ob_start();
    include 'templates/messages.html.php';
    $output = ob_get_clean();

} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php'; 