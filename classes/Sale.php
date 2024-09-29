<?php
class Sale {
    private $conn;
    private $table_name = "sales";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($sale_date, $customer_name, $total_amount, $status) {
        $query = "INSERT INTO " . $this->table_name . " SET sale_date=:sale_date, customer_name=:customer_name, total_amount=:total_amount, status=:status";
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
}
