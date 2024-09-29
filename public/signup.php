<?php
include_once '../config/database.php';
include_once '../classes/User.php';
include_once '../classes/Role.php'; 

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$role = new Role($db);
$roles = $role->read(); // Fetch roles for dropdown

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id']; 

    if ($user->create($username, $password, $email, $role_id)) {
        echo "User registered successfully.";
    } else {
        echo "Error registering user.";
    }
}

include_once '../templates/header.php';
?>

<h1>Sign Up</h1>
<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="email" name="email" placeholder="Email" required>
    
    <label for="role_id">Select Role:</label>
    <select name="role_id" id="role_id" required>
        <option value="">Select a role</option>
        <?php foreach ($roles as $row): ?>
            <option value="<?php echo $row['role_id']; ?>"><?php echo $row['role_name']; ?></option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit">Sign Up</button>
</form>
<a href="login.php">Already registered?</a>

<?php include_once '../templates/footer.php'; ?>
