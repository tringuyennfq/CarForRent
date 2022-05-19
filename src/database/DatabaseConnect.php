<?php

namespace Tringuyen\CarForRent\database;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class DatabaseConnect
{
    private static $conn;
    private static $dotenv;
    public static function getConnection(): PDO
    {
        if (!self::$conn) {
            self::$dotenv  =  Dotenv::createImmutable(__DIR__ . '/../');
            self::$dotenv->load();
            $host = $_ENV['HOST'];
            $username = $_ENV['USERNAME'];
            $password = $_ENV['PASSWORD'];
            $database = $_ENV['DATABASE'];

            try {
                self::$conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}
