<?php
class PurchaseOrder {
    private $conn;
    private $table_name = "purchase_orders"; // Your actual table name

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($supplier_id, $order_date, $status, $total_amount) {
        $query = "INSERT INTO " . $this->table_name . " (supplier_id, order_date, status, total_amount) VALUES (:supplier_id, :order_date, :status, :total_amount)";
        
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

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $supplier_id, $order_date, $status, $total_amount) {
        $query = "UPDATE " . $this->table_name . " SET supplier_id = :supplier_id, order_date = :order_date, status = :status, total_amount = :total_amount WHERE order_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->bindParam(':order_date', $order_date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
