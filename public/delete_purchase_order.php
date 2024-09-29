<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin or Manager
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) { // 1 = Admin, 2 = Manager
    echo "Access denied. You do not have permission to access this page.";
    exit;
}

include_once '../config/database.php';
include_once '../classes/PurchaseOrder.php';

$database = new Database();
$db = $database->getConnection();

$purchaseOrder = new PurchaseOrder($db);

if (isset($_GET['id'])) {
    $purchase_order_id = $_GET['id'];

    if ($purchaseOrder->delete($purchase_order_id)) {
        echo "Purchase Order deleted successfully.";
    } else {
        echo "Error deleting Purchase Order.";
    }
} else {
    echo "No order ID specified.";
}

?>

<a href="view_purchase_orders.php">Back to Purchase Orders List</a>
