<?php
/**
* Класс User
* Представляет пользователя менеджера задач.
*/
class User
{
private $id;
private $name;
private $email;

/**
* @param int $id
* @param string $name
* @param string $email
*/
public function __construct(int $id, string $name, string $email)
{
$this->id = $id;
$this->name = $name;
$this->email = $email;
}

// Геттеры и сеттеры

/**
* @return int
*/
public function getId(): int
{
return $this->id;
}

/**
* @param int $id
*/
public function setId(int $id): void
{
$this->id = $id;
}

// ...
}

/**
* Класс Task
* Представляет задачу в менеджере задач.
*/
class Task
{
private $id;
private $title;
private $description;
private $status;
private $user;

/**
* @param int $id
* @param string $title
* @param string $description
* @param string $status
* @param User $user
*/
public function __construct(int $id, string $title, string $description, string $status, User $user)
{
$this->id = $id;
$this->title = $title;
$this->description = $description;
$this->status = $status;
$this->user = $user;
}

// Геттеры и сеттеры

/**
* @return int
*/
public function getId(): int
{
return $this->id;
}

/**
* @param int $id
*/
public function setId(int $id): void
{
$this->id = $id;
}

// ...
}

/**
* Класс TaskManager
* Представляет менеджер задач.
*/
class TaskManager
{
private $db;

/**
* @param DBConnection $db
*/
public function __construct(DBConnection $db)
{
$this->db = $db;
}

/**
* @param User $user
* @param string $title
* @param string $description
* @return Task
*/
public function createTask(User $user, string $title, string $description): Task
{
// Реализация
}

/**
* @param Task $task
*/
public function updateTask(Task $task): void
{
// Реализация
}

/**
* @param Task $task
*/
public function deleteTask(Task $task): void
{
// Реализация
}

// ...
}

/**
* Класс DBConnection
* Представляет подключение к базе данных.
*/
final class DBConnection
{
private $pdo;

/**
* @return \PDO
* @throws \Exception
*/
public function connect(): \PDO
{
// Реализация
}

/**
* @return DBConnection
*/
public static function get(): DBConnection
{
// Реализация
}

private function __construct()
{
// Реализация
}
}
?>