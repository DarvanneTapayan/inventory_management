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
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();

$supplier = new Supplier($db);
$suppliers = $supplier->read();

// Include header
include_once '../templates/header.php';
?>

<h1>Suppliers List</h1>
<table border="1">
    <tr>
        <th>Supplier ID</th>
        <th>Supplier Name</th>
        <th>Contact Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($suppliers as $row): ?>
        <tr>
            <td><?php echo $row['supplier_id']; ?></td>
            <td><?php echo $row['supplier_name']; ?></td>
            <td><?php echo $row['contact_name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td>
                <a href="edit_supplier.php?id=<?php echo $row['supplier_id']; ?>">Edit</a> |
                <a href="delete_supplier.php?id=<?php echo $row['supplier_id']; ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="add_supplier.php">Add Supplier</a>

<?php
// Include footer
include_once 'footer.php';
?>
