<?php
class Database {
    private $conn; // Connection variable

    public function __construct($db_connection) {
        $this->conn = $db_connection; // Use the provided database connection
    }

    // Method to execute a query
    public function execute($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    // Method to fetch all results
    public function fetchAll($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch a single result
    public function fetchOne($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to execute insert, update, delete
    public function executeUpdate($query, $params = []) {
        $stmt = $this->execute($query, $params);
        return $stmt->rowCount(); // Return number of affected rows
    }
}
?>
