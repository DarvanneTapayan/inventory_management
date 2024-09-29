<?php
session_start();
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Hardcoded credentials for demo purposes (replace this with database check in a real application)
$users = [
    ['username' => 'admin', 'password' => 'admin123', 'role_id' => 1],
    ['username' => 'manager', 'password' => 'manager123', 'role_id' => 2],
    ['username' => 'staff', 'password' => 'staff123', 'role_id' => 3],
];

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check user credentials
    $found = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user_id'] = $username; // You might want to use a user ID instead
            $_SESSION['role_id'] = $user['role_id'];
            $found = true;
            break;
        }
    }

    if ($found) {
        // Redirect based on role
        switch ($_SESSION['role_id']) {
            case 1:
                header("Location: admin_dashboard.php");
                break;
            case 2:
                header("Location: manager_dashboard.php");
                break;
            case 3:
                header("Location: staff_dashboard.php");
                break;
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Login</h1>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
