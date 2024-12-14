<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css\style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <title><?=$title?></title>
        <style>
            nav {
                background-color: #2d2d2d !important;
                color: white !important;
            }
        </style>
    </head>
    <body>
        <!-- Left Navigation -->
        <nav>
            <ul class="nav-links">
                <li><a href="feed.php" class="<?= $currentPage === 'feed' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>Home
                </a></li>
                <li><a href="message.php" class="<?= $currentPage === 'message' ? 'active' : '' ?>">
                    <i class="fas fa-question-circle"></i>Contact An Admin
                </a></li>
                <?php if($_SESSION['isAdmin']): ?>
                    <li><a href="admin/manage_users.php" class="<?= $currentPage === 'admin' ? 'active' : '' ?>">
                        <i class="fas fa-user-shield"></i>Admin Page
                    </a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <!-- Top Header -->
        <header class="main-header">
            <div class="logo-container">
                <img src="uploads/logo.png" alt="Site Logo">
            </div>
            <h2>Welcome to the Greenwich Q&A</h2>
            <div>
                <a href="profile.php" class="btn">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
                <a href="actions/logout.php" class="btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <?=$output?>
        </main>
        <script src="js/likes.js"></script>
        <script src="https://kit.fontawesome.com/c34c241cd2.js" crossorigin="anonymous"></script>
    </body>
</html>