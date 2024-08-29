<?php

namespace App\DataBase;

use PDO;
use PDOException;


class Connection
{
    private static $instance;
    private $pdo;

    private function __construct()
    {

        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $dsn = "mysql:host=$host;dbname=$dbname";

        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->createUsersTable();
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query($sql)
    {
        return $this->pdo->query($sql);
    }

    public function prepare($sql)
    {
        return $this->pdo->prepare($sql);
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function getConnection()
    {
        return $this->pdo;
    }

    private function createUsersTable()
    {
        // Verificar si la tabla users existe
        $query = "
            SELECT 1
            FROM information_schema.tables
            WHERE table_schema = :dbname
            AND table_name = 'users'
            LIMIT 1;
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['dbname' => getenv('DB_NAME')]);

        if ($stmt->fetch() === false) {
            // Crear la tabla users si no existe
            $createQuery = "
                CREATE TABLE users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    email VARCHAR(255) UNIQUE NOT NULL,
                    name VARCHAR(255) NOT NULL,
                    password VARCHAR(255) NOT NULL
                )
            ";

            try {
                $this->pdo->exec($createQuery);
            } catch (PDOException $e) {
                die('Error al crear la tabla users: ' . $e->getMessage());
            }
        }
    }
}