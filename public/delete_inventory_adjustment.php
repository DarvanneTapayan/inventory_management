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
include_once '../classes/InventoryAdjustment.php';

$database = new Database();
$db = $database->getConnection();
$inventoryAdjustment = new InventoryAdjustment($db);

if (isset($_GET['id'])) {
    $adjustment_id = $_GET['id'];
    if ($inventoryAdjustment->delete($adjustment_id)) {
        echo "Inventory adjustment deleted successfully.";
    } else {
        echo "Error deleting inventory adjustment.";
    }
} else {
    echo "No adjustment ID specified.";
}

header("Location: view_inventory_adjustments.php"); // Redirect back to inventory adjustments view
exit;
?>
