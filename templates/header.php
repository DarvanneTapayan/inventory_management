<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <header>
        <h1>Inventory Management System</h1>
        <nav>
            <ul>
                <li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <?php if ($_SESSION['role_id'] == 1): ?>
                            <a href="admin_dashboard.php">Home</a> <!-- Admin Dashboard -->
                        <?php elseif ($_SESSION['role_id'] == 2): ?>
                            <a href="manager_dashboard.php">Home</a> <!-- Manager Dashboard -->
                        <?php elseif ($_SESSION['role_id'] == 3): ?>
                            <a href="staff_dashboard.php">Home</a> <!-- Staff Dashboard -->
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="index.php">Home</a> <!-- Public Home -->
                    <?php endif; ?>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
