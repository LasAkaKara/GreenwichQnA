<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || !$_SESSION['isAdmin']) {
    header('Location: ../login.php');
    exit();
}

try {
    include 'includes/DatabaseConnector.php';
    include 'includes/DatabaseFunctions.php';

    if (isset($_POST['submit'])) {
        // Validate inputs
        if (empty($_POST['module_id']) || empty($_POST['module_name']) || empty($_POST['lecturer'])) {
            throw new Exception('All fields are required');
        }
        
        // Insert the new module
        $sql = 'INSERT INTO modules (module_id, module_name, lecturer) 
                VALUES (:module_id, :module_name, :lecturer)';
        //Execute query
        query($pdo, $sql, [
            'module_id' => $_POST['module_id'],
            'module_name' => $_POST['module_name'],
            'lecturer' => $_POST['lecturer']
        ]);
        //Redirect to manage modules after successful addition
        header('Location: manage_modules.php');
        exit();
    } else {
        $title = 'Add New Module';
        ob_start();
        include 'templates/addmodule.html.php';
        $output = ob_get_clean();
    }
} catch (Exception $e) {
    $title = 'An error occurred';
    $output = $e->getMessage();
}

include 'templates/layout.html.php'; 