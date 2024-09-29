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
include_once '../classes/Sale.php';

$database = new Database();
$db = $database->getConnection();
$sale = new Sale($db);

$sales = $sale->read();

include_once '../templates/header.php';
?>

<h1>Sales List</h1>
<table border="1">
    <tr>
        <th>Sale ID</th>
        <th>Customer Name</th>
        <th>Total Amount</th>
        <th>Sale Date</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($sales as $row): ?>
        <tr>
            <td><?php echo $row['sale_id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td><?php echo $row['sale_date']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td>
                <a href="edit_sale.php?id=<?php echo $row['sale_id']; ?>">Edit</a> |
                <a href="delete_sale.php?id=<?php echo $row['sale_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="add_sale.php">Add Sale</a>

<?php include_once '../templates/footer.php'; ?>
