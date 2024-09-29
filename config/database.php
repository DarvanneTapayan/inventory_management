<?php
class Database {
    private $host = "localhost"; // Database host
    private $db_name = "inventory_management"; // Database name
    private $username = "root"; // Database username
    private $password = ""; // Database password (default is empty for XAMPP)
    public $conn; // Connection variable

    // Method to get the database connection
    public function getConnection() {
        $this->conn = null; // Initialize connection to null

        try {
            // Create a new PDO instance
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // Set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            // Handle connection error
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn; // Return the connection
    }
}
?>
