<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin or Manager or Staff
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3) {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Sale.php';

$database = new Database();
$db = $database->getConnection();
$sale = new Sale($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    if ($sale->create(date("Y-m-d H:i:s"), $customer_name, $total_amount, $status)) {
        echo "Sale added successfully.";
    } else {
        echo "Error adding sale.";
    }
}

include_once '../templates/header.php';
?>

<h1>Add Sale</h1>
<form method="POST" action="">
    <input type="text" name="customer_name" placeholder="Customer Name" required>
    <input type="number" name="total_amount" placeholder="Total Amount" required>
    
    <label for="status">Sale Status:</label>
    <select name="status" required>
        <option value="Pending">Pending</option>
        <option value="Completed">Completed</option>
        <option value="Cancelled">Cancelled</option>
    </select>

    <button type="submit">Add Sale</button>
</form>

<?php include_once '../templates/footer.php'; ?>
