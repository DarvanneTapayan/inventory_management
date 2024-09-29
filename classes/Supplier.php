<?php
class Supplier {
    private $conn;
    private $table_name = "suppliers"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($supplier_name, $contact_name, $phone, $email, $address) {
        $query = "INSERT INTO " . $this->table_name . " (supplier_name, contact_name, phone, email, address) VALUES (:supplier_name, :contact_name, :phone, :email, :address)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':supplier_name', $supplier_name);
        $stmt->bindParam(':contact_name', $contact_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);

        return $stmt->execute();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readOne($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE supplier_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $supplier_name, $contact_name, $phone, $email, $address) {
        $query = "UPDATE " . $this->table_name . " SET supplier_name = :supplier_name, contact_name = :contact_name, phone = :phone, email = :email, address = :address WHERE supplier_id = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':supplier_name', $supplier_name);
        $stmt->bindParam(':contact_name', $contact_name);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE supplier_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
?>
