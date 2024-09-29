<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin or Manager
if ($_SESSION['role_id'] != 1 && $_SESSION['role_id'] != 2) {
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
        echo "Purchase order deleted successfully.";
    } else {
        echo "Error deleting purchase order.";
    }
} else {
    echo "No purchase order ID specified.";
}

header("Location: view_purchase_orders.php"); // Redirect back to purchase orders view
exit;
?>
