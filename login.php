<?php
session_start();

// If user is already logged in, redirect appropriately
if (isset($_SESSION['user_id'])) {
    header('Location: feed.php');
    exit();
}

if (isset($_POST['login'])) {
    try {
        include 'includes/DatabaseConnector.php';
        include 'includes/DatabaseFunctions.php';

        $email = $_POST['email'];
        $password = md5($_POST['password']);

        // Query to check user credentials
        $sql = 'SELECT user_id, username, email, password, isAdmin 
                FROM users 
                WHERE email = :email AND password = :password AND isDeleted = 0';

        $result = query($pdo, $sql, [
            'email' => $email,
            'password' => $password
        ])->fetch();

        if ($result) {
            // Store user data in session
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['isAdmin'] = $result['isAdmin'];
            // Redirect to feed page
            header('Location: feed.php');
            exit();
        } else {
            // If credentials are invalid, set error message
            $error = 'Invalid email or password';
        }
    } catch (PDOException $e) {
        $error = 'Database error: ' . $e->getMessage();
    }
}

// Display login form
include 'templates/login.html.php';