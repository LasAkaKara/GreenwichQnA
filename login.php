<?php
session_start();

// If user is already logged in, redirect to feed
if (isset($_SESSION['user_id'])) {
    header('Location: feed.php');
    exit();
}

try {
    // Include database connections
    include 'includes\DatabaseConnector.php';
    include 'includes\DatabaseFunctions.php';

    // Handle login form submission
    if (isset($_POST['submit'])) {
        // Get user credentials from form
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Hash password (Note: md5 not recommended for production)

        // Query to check user credentials
        $sql = 'SELECT user_id, username, isAdmin, profile_picture FROM users 
                WHERE email = :email AND password = :password AND isDeleted = 0';
        
        $user = query($pdo, $sql, [
            'email' => $email,
            'password' => $password
        ])->fetch();

        // If user found, set session and redirect
        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['isAdmin'] = $user['isAdmin'];
            $_SESSION['user_avatar'] = $user['profile_picture'];
            
            header('Location: feed.php');
            exit();
        } else {
            $error = 'Invalid login credentials';
        }
    }

    $title = 'Login';
    
    // Load login template
    ob_start();
    include 'templates\login.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage();
}
?>