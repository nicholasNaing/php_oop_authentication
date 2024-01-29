<?php
    // Db class for handling database connection
    class Db {
        // Database connection parameters
        private $host = "localhost";
        private $username = "root";
        private $password = "";
        private $dbName = "MindFlare";

        // Method to establish a database connection
        protected function connection() {
            // Construct the Data Source Name (DSN)
            $dsn = "mysql:host=" . $this->host . ";" . "dbname=" . $this->dbName;

            // Create a new PDO (PHP Data Objects) instance for database connection
            $pdo = new PDO($dsn, $this->username, $this->password);

            // Set PDO attribute to fetch associative arrays by default
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Return the PDO instance for database operations
            return $pdo;
        }
    }
?>
