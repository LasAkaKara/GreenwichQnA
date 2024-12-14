<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

try {
    include '../includes/DatabaseConnector.php';
    include '../includes/DatabaseFunctions.php';

    // Soft delete the user
    $sql = 'UPDATE users SET isDeleted = 1 WHERE user_id = :id';
    query($pdo, $sql, ['id' => $_SESSION['user_id']]);

    // Log out the user
    include '../actions/logout.php';

} catch (PDOException $e) {
    die('Error deleting account: ' . $e->getMessage());
} 