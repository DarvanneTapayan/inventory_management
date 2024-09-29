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

$adjustments = $inventoryAdjustment->read();

include_once '../templates/header.php';
?>

<h1>Inventory Adjustments List</h1>
<table border="1">
    <tr>
        <th>Adjustment ID</th>
        <th>Product ID</th>
        <th>Adjustment Type</th>
        <th>Quantity</th>
        <th>Reason</th>
        <th>Adjustment Date</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($adjustments as $row): ?>
        <tr>
            <td><?php echo $row['adjustment_id']; ?></td>
            <td><?php echo $row['product_id']; ?></td>
            <td><?php echo $row['adjustment_type']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['reason']; ?></td>
            <td><?php echo $row['adjustment_date']; ?></td>
            <td>
                <a href="edit_inventory_adjustment.php?id=<?php echo $row['adjustment_id']; ?>">Edit</a> |
                <a href="delete_inventory_adjustment.php?id=<?php echo $row['adjustment_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="add_inventory_adjustment.php">Add Inventory Adjustment</a>

<?php include_once '../templates/footer.php'; ?>
