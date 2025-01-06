<?php
// TaskGateway.php

class TaskGateway
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->getPdo();
    }

    public function create($user_id, $title, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (user_id, title, description) VALUES (:user_id, :title, :description)");
        $stmt->execute([
            'user_id' => $user_id,
            'title' => $title,
            'description' => $description
        ]);
    }

    public function read($task_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $task_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($task_id, $title, $description, $status)
    {
        $stmt = $this->pdo->prepare("UPDATE tasks SET title = :title, description = :description, status = :status WHERE id = :id");
        $stmt->execute([
            'id' => $task_id,
            'title' => $title,
            'description' => $description,
            'status' => $status
        ]);
    }

    public function delete($task_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $task_id]);
    }

    public function getAllTasksByUser($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC");
        $stmt->execute(['user_id' => $user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
