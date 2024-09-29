<?php
session_start();
include_once '../config/database.php';
include_once '../classes/User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $loggedInUser = $user->login($username, $password);
    
    if ($loggedInUser) {
        $_SESSION['user_id'] = $loggedInUser['user_id'];
        $_SESSION['role_id'] = $loggedInUser['role_id'];

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
            default:
                header("Location: customer_dashboard.php");
                break;
        }
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}

include_once '../templates/header.php';
?>

<h1>Login</h1>
<?php if (!empty($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php endif; ?>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<?php include_once '../templates/footer.php'; ?>
