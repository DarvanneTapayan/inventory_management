<?php
class InventoryAdjustment {
    private $conn;
    private $table_name = "inventory_adjustments"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($product_id, $adjustment_type, $quantity, $reason, $adjustment_date) {
        $query = "INSERT INTO " . $this->table_name . " (product_id, adjustment_type, quantity, reason, adjustment_date) VALUES (:product_id, :adjustment_type, :quantity, :reason, :adjustment_date)";
        
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

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE adjustment_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $product_id, $adjustment_type, $quantity, $reason, $adjustment_date) {
        $query = "UPDATE " . $this->table_name . " SET product_id = :product_id, adjustment_type = :adjustment_type, quantity = :quantity, reason = :reason, adjustment_date = :adjustment_date WHERE adjustment_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':adjustment_type', $adjustment_type);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':reason', $reason);
        $stmt->bindParam(':adjustment_date', $adjustment_date);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE adjustment_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
