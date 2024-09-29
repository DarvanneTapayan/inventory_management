<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the user is an Admin
if ($_SESSION['role_id'] != 1) { // 1 = Admin
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
    $existing_supplier = $supplier->readOne($supplier_id); // Fetch the existing supplier details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $supplier_name = $_POST['supplier_name'];
        $contact_name = $_POST['contact_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        if ($supplier->update($supplier_id, $supplier_name, $contact_name, $phone, $email, $address)) {
            echo "Supplier updated successfully.";
        } else {
            echo "Error updating supplier.";
        }
    }
} else {
    echo "No supplier ID specified.";
    exit;
}

// Include header
include_once '../templates/header.php';
?>

<h1>Edit Supplier</h1>
<form method="POST" action="">
    <input type="text" name="supplier_name" value="<?php echo $existing_supplier['supplier_name']; ?>" required>
    <input type="text" name="contact_name" value="<?php echo $existing_supplier['contact_name']; ?>">
    <input type="text" name="phone" value="<?php echo $existing_supplier['phone']; ?>">
    <input type="email" name="email" value="<?php echo $existing_supplier['email']; ?>">
    <input type="text" name="address" value="<?php echo $existing_supplier['address']; ?>">
    <button type="submit">Update Supplier</button>
</form>

<?php
// Include footer
include_once '../templates/footer.php';
?>
