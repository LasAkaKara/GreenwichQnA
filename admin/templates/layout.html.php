<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="..\css\style.css">
        <?= $additionalHead ?? '' ?>
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
                <li><a href="../feed.php" class="<?= $currentPage === 'feed' ? 'active' : '' ?>">
                    <i class="fas fa-home"></i>Back to Feed
                </a></li>
                <li><a href="manage_users.php" class="<?= $currentPage === 'feed' ? 'active' : '' ?>">
                    <i class="fas fa-user"></i>Manage Users
                </a></li>

                <li><a href="manage_modules.php" class="<?= $currentPage === 'feed' ? 'active' : '' ?>">
                    <i class="fas fa-book"></i>Manage Modules
                </a></li>
                <li><a href="messages.php" class="<?= $currentPage === 'feed' ? 'active' : '' ?>">
                    <i class="fas fa-message"></i>View Messages
                </a></li>
            </ul>
        </nav>

        <!-- Top Header -->
        <header class="main-header">
            <div class="logo-container">
                <img src="../uploads/logo.png" alt="Site Logo">
                <h2 style="text-align:center">Administration Area</h2>
            </div>
            
        </header>


        <!-- Main Content -->
        <main class="main-content">
            <?=$output?>
        </main>

        <script src="https://kit.fontawesome.com/c34c241cd2.js" crossorigin="anonymous"></script>
    </body>
</html>