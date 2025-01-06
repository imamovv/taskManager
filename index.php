<?php
// index.php

require 'Database.php';
require 'UserGateway.php';
require 'TaskGateway.php';

session_start();

$userGateway = new UserGateway();
$taskGateway = new TaskGateway();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'register') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $userGateway->register($username, $password);
            echo "Registration successful!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $userGateway->authenticate($username, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'create_task' && isset($_SESSION['user_id'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        try {
            $taskGateway->create($_SESSION['user_id'], $title, $description);
            echo "Task created successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'update_task' && isset($_SESSION['user_id'])) {
        $task_id = $_POST['task_id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];

        try {
            $taskGateway->update($task_id, $title, $description, $status);
            echo "Task updated successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'delete_task' && isset($_SESSION['user_id'])) {
        $task_id = $_POST['task_id'];

        try {
            $taskGateway->delete($task_id);
            echo "Task deleted successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'logout') {
        session_destroy();
        echo "Logged out!";
    }
}

if (!isset($_SESSION['user_id'])) {
?>
    <h1>Register</h1>
    <form method="post">
        <input type="hidden" name="action" value="register">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Register</button>
    </form>

    <h1>Login</h1>
    <form method="post">
        <input type="hidden" name="action" value="login">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Login</button>
    </form>
<?php
} else {
?>
    <h1>Tasks</h1>
    <a href="#" onclick="document.getElementById('taskForm').style.display='block';">Add Task</a>
    <form id="taskForm" method="post" style="display:none;">
        <input type="hidden" name="action" value="create_task">
        Title: <input type="text" name="title"><br>
        Description: <textarea name="description"></textarea><br>
        <button type="submit">Create Task</button>
    </form>

    <?php
    $tasks = $taskGateway->getAllTasksByUser($_SESSION['user_id']);
    foreach ($tasks as $task) {
    ?>
        <div>
            <h2><?php echo htmlspecialchars($task['title']); ?></h2>
            <p><?php echo nl2br(htmlspecialchars($task['description'])); ?></p>
            <form method="post" style="display:inline;">
                <input type="hidden" name="action" value="update_task">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                Title: <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>"><br>
                Description: <textarea name="description"><?php echo htmlspecialchars($task['description']); ?></textarea><br>
                Status:
                <select name="status">
                    <option value="pending" <?php if ($task['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                    <option value="in_progress" <?php if ($task['status'] === 'in_progress') echo 'selected'; ?>>In Progress</option>
                    <option value="completed" <?php if ($task['status'] === 'completed') echo 'selected'; ?>>Completed</option>
                </select><br>
                <button type="submit">Update Task</button>
            </form>
            <form method="post" style="display:inline;">
                <input type="hidden" name="action" value="delete_task">
                <input type="hidden" name="task_id" value="<?php echo $task['id']; ?>">
                <button type="submit">Delete Task</button>
            </form>
        </div>
    <?php
    }
    ?>

    <form method="post">
        <input type="hidden" name="action" value="logout">
        <button type="submit">Logout</button>
    </form>
<?php
}
?>