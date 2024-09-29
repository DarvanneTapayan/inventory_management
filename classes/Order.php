<?php
class Order {
    private $conn;
    private $table_name = "orders"; // Assuming you have an orders table

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($customer_id, $total_amount) {
        $query = "INSERT INTO " . $this->table_name . " (customer_id, total_amount, order_date) VALUES (:customer_id, :total_amount, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);
        $stmt->bindParam(':total_amount', $total_amount);

        return $stmt->execute(); // Return true on success
    }
}
?>
