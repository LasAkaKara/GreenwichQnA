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

    if (isset($_POST['submit']) && isset($_POST['module_name']) && isset($_POST['lecturer'])) {
        // Update module
        $sql = 'UPDATE modules 
                SET module_name = :module_name, 
                    lecturer = :lecturer 
                WHERE module_id = :module_id';
        //Execute query
        query($pdo, $sql, [
            'module_id' => $_POST['module_id'],
            'module_name' => $_POST['module_name'],
            'lecturer' => $_POST['lecturer']
        ]);
        //Redirect to manage modules after successful update
        header('location: manage_modules.php');
        exit();
    } else {
        // Get module details
        $sql = 'SELECT * FROM modules WHERE module_id = :id AND isDeleted = 0';
        $module = query($pdo, $sql, ['id' => $_GET['id']])->fetch();

        if (!$module) {
            header('Location: manage_modules.php');
            exit();
        }

        $title = 'Edit Module';
        ob_start();
        include 'templates/editmodule.html.php';
        $output = ob_get_clean();
    }
} catch(PDOException $e) {
    $title = "An error occurred.";
    $output = $e->getMessage();
}
include 'templates/layout.html.php'; 