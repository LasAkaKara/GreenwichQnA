<?php
session_start();

if (isset($_POST['register'])) {
    try {
        include '..\includes\DatabaseConnector.php';
        include '..\includes\DatabaseFunctions.php';

        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validation
        $errors = [];
        
        // Check if email already exists
        $existingUser = query($pdo, 
            'SELECT email FROM users WHERE email = :email', 
            ['email' => $email]
        )->fetch();

        if ($existingUser) {
            $errors[] = 'Email already registered';
        }

        // Password validation
        if (strlen($password) < 8) {
            $errors[] = 'Password must be at least 8 characters long';
        }

        if ($password !== $confirm_password) {
            $errors[] = 'Passwords do not match';
        }

        // If no errors, proceed with registration
        if (empty($errors)) {
            // Hash password
            $hashedPassword = md5($password);

            // Insert new user
            $sql = 'INSERT INTO users (username, email, password, isAdmin, isDeleted) 
                    VALUES (:username, :email, :password, 0, 0)';
            
            query($pdo, $sql, [
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);
            $userId = $pdo->lastInsertId();

            // Set session variables
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['isAdmin'] = 0; // New users are not admins by default

            // Redirect to feed page
            header('Location: ..\feed.php');
            exit();
        }
    } catch (PDOException $e) {
        $errors[] = 'Database error: ' . $e->getMessage();
    }
}

// Display registration form
include '..\templates\register.html.php';