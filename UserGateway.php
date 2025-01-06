<?php
// UserGateway.php

class UserGateway
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    public function register($username, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password_hash) VALUES (:username, :password_hash)");
        $stmt->execute([
            'username' => $username,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function authenticate($username, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            return $user;
        }
        return null;
    }
}
