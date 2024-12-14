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
    // If the form is submitted, update the user information
    if (isset($_POST['username']) && isset($_POST['email'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        
        // Update user information
        $parameters = ['username' => $username, 'email' => $email, 'id' => $_SESSION['user_id']];
        
        $sql = 'UPDATE users SET username = :username, email = :email';
        
        // Add password update if provided
        if (isset($_POST['new_password'])) {
            $sql .= ', password = :password';
            $parameters['password'] = md5($_POST['new_password']);
        }
        
        // Handle profile picture upload
        if (isset($_FILES['avatar'])) {
            $upload_type = 'avatars';
            include 'actions/upload.php';
            $sql .= ', profile_picture = :avatar';
            $parameters['avatar'] = $target_file;
        }
        // Complete the SQL query
        $sql .= ' WHERE user_id = :id';
        query($pdo, $sql, $parameters);
        // Redirect to profile page
        header('Location: profile.php');
        exit();
    }
    else{
        // Fetch current user data
        $sql = 'SELECT username, email, profile_picture FROM users WHERE user_id = :id';
        $user = query($pdo, $sql, ['id' => $_SESSION['user_id']])->fetch();

        $title = 'Edit Profile';
        
        ob_start();
        include 'templates/editprofile.html.php';
        $output = ob_get_clean();
    }
} catch (PDOException $e) {
    $title = 'Error';
    $output = 'Database error: ' . $e->getMessage();
}

include 'templates/layout.html.php'; 