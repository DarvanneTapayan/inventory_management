<?php
class InventoryAdjustment {
    private $conn;
    private $table_name = "inventory_adjustments";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($product_id, $adjustment_type, $quantity, $reason, $adjustment_date) {
        $query = "INSERT INTO " . $this->table_name . " SET product_id=:product_id, adjustment_type=:adjustment_type, quantity=:quantity, reason=:reason, adjustment_date=:adjustment_date";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':adjustment_type', $adjustment_type);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':adjustment_date', $adjustment_date);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
