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
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();
$supplier = new Supplier($db);

if (isset($_GET['id'])) {
    $supplier_id = $_GET['id'];
    if ($supplier->delete($supplier_id)) {
        echo "Supplier deleted successfully.";
    } else {
        echo "Error deleting supplier.";
    }
} else {
    echo "No supplier ID specified.";
}

header("Location: view_suppliers.php"); // Redirect back to suppliers view
exit;
?>
