<?php

namespace App\Repositories;

use App\Models\User;
use App\Exceptions\UserDoesNotExistException;
use App\DataBase\Connection;
use PDO;

class UserRepository implements UserRepositoryInterface {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Connection::getInstance()->getConnection();
    }

    public function save(User $user) {
        
        $query = "INSERT INTO users (email, name, password) VALUES (:email, :name, :password)";
        $stmt = $this->pdo->prepare($query);

        // Almacenar los resultados de los métodos en variables
        $email = $user->getEmail();
        $name = $user->getName();
        $password = $user->getPassword();

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()) {
             return $this->findById($this->pdo->lastInsertId());
        }else {
            throw new \Exception('Error al guardar el usuario');

        }
    }

    public function findById(string $id) {
        $stmt = $this->pdo->prepare('SELECT id,name,email FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $data;
        } else {
            throw new UserDoesNotExistException();
        }
    }

    public function update($id, $user) {
        
        
        $stmt = $this->pdo->prepare('UPDATE users SET name = :name, password = :password WHERE id = :id');
        
        $stmt->execute([
            'name' => $user->getName(),
            'password' => $user->getPassword(),
            'id' => $id
        ]);

        
        if ($stmt->rowCount() === 1) {
            return $this->findById($id);
        } else {
            throw new UserDoesNotExistException();
        }
    }

    public function delete(User $user) {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE email = :email');
        $stmt->execute(['email' => $user->getEmail()]);

        if ($stmt->rowCount() !== 0) {
            return $this->pdo->lastInsertId();
        } else {
            throw new UserDoesNotExistException();
        }
    }

    public function findAll() {
        $stmt = $this->pdo->prepare('SELECT id,name,email FROM users');
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}