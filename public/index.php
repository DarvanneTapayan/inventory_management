<?php
session_start();

// Redirect logged-in users to their respective dashboards
if (isset($_SESSION['user_id'])) {
    switch ($_SESSION['role_id']) {
        case 1: // Admin
            header("Location: admin_dashboard.php");
            exit;
        case 2: // Manager
            header("Location: manager_dashboard.php");
            exit;
        case 3: // Staff
            header("Location: staff_dashboard.php");
            exit;
        default:
            header("Location: login.php");
            exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Inventory Management System</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Welcome to the Inventory Management System</h2>
        <p>Please log in to access the system's functionalities.</p>
    </main>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Inventory Management System. All rights reserved.</p>
    </footer>
</body>
</html>
