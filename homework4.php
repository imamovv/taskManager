<?php
/**
* Интерфейс Observer
* Представляет наблюдателя в шаблоне наблюдателя.
*/
interface Observer
{
/**
* @param Task $task
*/
public function update(Task $task): void;
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
private $observers;
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
$this->observers = new \SplObjectStorage();
}

/**
* @return int
*/
public function getId(): int
{
return $this->id;
}

/**
* @return string
*/
public function getTitle(): string
{
return $this->title;
}

/**
* @return string
*/
public function getDescription(): string
{
return $this->description;
}

/**
* @return string
*/
public function getStatus(): string
{
return $this->status;
}

/**
* @return User
*/
public function getUser(): User
{
return $this->user;
}

/**
* @param Observer $observer
*/
public function attach(Observer $observer): void
{
$this->observers->attach($observer);
}

/**
* @param Observer $observer
*/
public function detach(Observer $observer): void
{
$this->observers->detach($observer);
}

/**
* @param string $status
*/
public function setStatus(string $status): void
{
$oldStatus = $this->status;
$this->status = $status;
if ($oldStatus !== $status) {
$this->notifyObservers();
}
}

/**
* Уведомляет всех наблюдателей о изменении статуса.
*/
private function notifyObservers(): void
{
foreach ($this->observers as $observer) {
$observer->update($this);
}
}
}

/**
* Класс TaskManager
* Представляет менеджер задач.
*/
class TaskManager
{
private $db;
private $observers;

/**
* @param DBConnection $db
*/
public function __construct(DBConnection $db)
{
$this->db = $db;
$this->observers = new \SplObjectStorage();
}

/**
* @param Observer $observer
*/
public function attach(Observer $observer): void
{
$this->observers->attach($observer);
}

/**
* @param Observer $observer
*/
public function detach(Observer $observer): void
{
$this->observers->detach($observer);
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
}
?>