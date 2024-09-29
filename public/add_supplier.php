<?php
include_once '../config/database.php';
include_once '../classes/Supplier.php';

$database = new Database();
$db = $database->getConnection();

$supplier = new Supplier($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supplier_name = $_POST['supplier_name'];
    $contact_name = $_POST['contact_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    if ($supplier->create($supplier_name, $contact_name, $phone, $email, $address)) {
        echo "Supplier added successfully.";
    } else {
        echo "Error adding supplier.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Supplier</title>
</head>
<body>
    <h1>Add Supplier</h1>
    <form method="POST" action="">
        <input type="text" name="supplier_name" placeholder="Supplier Name" required>
        <input type="text" name="contact_name" placeholder="Contact Name">
        <input type="text" name="phone" placeholder="Phone">
        <input type="email" name="email" placeholder="Email">
        <input type="text" name="address" placeholder="Address">
        <button type="submit">Add Supplier</button>
    </form>
</body>
</html>
