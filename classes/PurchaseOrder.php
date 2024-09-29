<?php
class PurchaseOrder {
    private $conn;
    private $table_name = "purchase_orders";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($supplier_id, $order_date, $status, $total_amount) {
        $query = "INSERT INTO " . $this->table_name . " SET supplier_id=:supplier_id, order_date=:order_date, status=:status, total_amount=:total_amount";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_amount', $total_amount);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
