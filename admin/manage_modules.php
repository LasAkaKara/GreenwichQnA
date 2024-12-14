<?php
session_start();
$currentPage = 'manage_modules';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: ../login.php');
    exit();
}

try {
    include 'includes/DatabaseConnector.php';
    include 'includes/DatabaseFunctions.php';

    // Get all modules that aren't deleted
    $sql = 'SELECT * FROM modules WHERE isDeleted = 0 ORDER BY module_id';
    $modules = query($pdo, $sql)->fetchAll();

    $title = 'Manage Modules';
    ob_start();
    include 'templates/manage_modules.html.php';
    $output = ob_get_clean();

} catch(PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php'; 