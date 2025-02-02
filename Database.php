<?php
class Database
{
    private static $pdo = null;

    public static function connect()
    {
        if (self::$pdo === null) {
            $dsn = "pgsql:host=postgres;port=5432;dbname=mydatabase";
            $user = "myuser";
            $password = "mypassword";

            try {
                self::$pdo = new PDO($dsn, $user, $password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}