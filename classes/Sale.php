<?php
class Sale {
    private $conn;
    private $table_name = "sales"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($sale_date, $customer_name, $total_amount, $status) {
        $query = "INSERT INTO " . $this->table_name . " (sale_date, customer_name, total_amount, status) VALUES (:sale_date, :customer_name, :total_amount, :status)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sale_date', $sale_date);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE sale_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $sale_date, $customer_name, $total_amount, $status) {
        $query = "UPDATE " . $this->table_name . " SET sale_date = :sale_date, customer_name = :customer_name, total_amount = :total_amount, status = :status WHERE sale_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sale_date', $sale_date);
        $stmt->bindParam(':customer_name', $customer_name);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE sale_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
