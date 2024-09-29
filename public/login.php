<?php
session_start();
include_once '../config/database.php';
include_once '../classes/User.php'; // Include User class

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials
    $user_data = $user->login($username, $password);

    if ($user_data) {
        $_SESSION['user_id'] = $user_data['username']; // or user ID if available
        $_SESSION['role_id'] = $user_data['role_id'];

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
            case 4: // Customer
                header("Location: customer_dashboard.php"); // Create a dashboard for customers
                break;
            default:
                header("Location: index.php");
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
    <a href="signup.php">Create an account.</a>
</body>
</html>
