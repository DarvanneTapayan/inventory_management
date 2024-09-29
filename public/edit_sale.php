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
    $existing_sale = $sale->readOne($sale_id); // Fetch the existing sale details

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sale_date = $_POST['sale_date'];
        $customer_name = $_POST['customer_name'];
        $total_amount = $_POST['total_amount'];
        $status = $_POST['status'];

        if ($sale->update($sale_id, $sale_date, $customer_name, $total_amount, $status)) {
            echo "Sale updated successfully.";
        } else {
            echo "Error updating sale.";
        }
    }
} else {
    echo "No sale ID specified.";
    exit;
}

// Include header
include_once '../templates/header.php';
?>

<h1>Edit Sale</h1>
<form method="POST" action="">
    <input type="date" name="sale_date" value="<?php echo $existing_sale['sale_date']; ?>" required>
    <input type="text" name="customer_name" value="<?php echo $existing_sale['customer_name']; ?>" required>
    <input type="number" name="total_amount" value="<?php echo $existing_sale['total_amount']; ?>" required>
    <input type="text" name="status" value="<?php echo $existing_sale['status']; ?>" required>
    <button type="submit">Update Sale</button>
</form>

<?php
// Include footer
include_once '../templates/footer.php';
?>
