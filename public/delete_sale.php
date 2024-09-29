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
include_once '../classes/Sale.php';

$database = new Database();
$db = $database->getConnection();

$sale = new Sale($db);

if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];

    if ($sale->delete($sale_id)) {
        echo "Sale deleted successfully.";
    } else {
        echo "Error deleting sale.";
    }
} else {
    echo "No sale ID specified.";
}

?>

<a href="view_sales.php">Back to Sales List</a>
