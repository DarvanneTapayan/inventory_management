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
include_once '../classes/InventoryAdjustment.php';

$database = new Database();
$db = $database->getConnection();

$inventoryAdjustment = new InventoryAdjustment($db);

if (isset($_GET['id'])) {
    $adjustment_id = $_GET['id'];

    if ($inventoryAdjustment->delete($adjustment_id)) {
        echo "Inventory Adjustment deleted successfully.";
    } else {
        echo "Error deleting Inventory Adjustment.";
    }
} else {
    echo "No adjustment ID specified.";
}

?>

<a href="view_inventory_adjustments.php">Back to Inventory Adjustments List</a>
