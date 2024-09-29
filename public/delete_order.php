<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin
if ($_SESSION['role_id'] != 1) {
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/Order.php';

$database = new Database();
$db = $database->getConnection();
$order = new Order($db);

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    if ($order->delete($order_id)) {
        echo "Order deleted successfully.";
    } else {
        echo "Error deleting order.";
    }
} else {
    echo "No order ID specified.";
}

header("Location: view_all_orders.php"); // Redirect back to orders view
exit;
?>
