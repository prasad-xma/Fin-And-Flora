<?php

class Database {
    private static $instance = null;

    public static function connect() {
        if(self::$instance === null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=mysql;dbname=finflora;charset=utf8mb4",
                    "finuser",
                    "user123"
                );
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

?>