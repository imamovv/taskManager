<?php

namespace app\models;

use app\Database;

class User
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->getConnection();
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (name, email) VALUES (?, ?)');
        $stmt->execute([$data['name'], $data['email']]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $stmt = $this->pdo->prepare('UPDATE users SET name = ?, email = ? WHERE id = ?');
        return $stmt->execute([$data['name'], $data['email'], $id]);
    }

    public function delete($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id = ?');
        return $stmt->execute([$id]);
    }
}