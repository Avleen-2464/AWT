<?php
// Database connection
class Database {
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new mysqli('localhost', 'root', '', 'your_database_name');
                if (self::$connection->connect_error) {
                    die("Connection failed: " . self::$connection->connect_error);
                }
            } catch (Exception $e) {
                die("Error connecting to database: " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
?>
