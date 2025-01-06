<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
</head>

<body>
    <h1>Users</h1>
    <a href="/mvc-project/public/create">Create User</a>
    <ul>
        <?php foreach ($users as $user): ?>
        <li>
            <a href="/mvc-project/public/user/<?php echo $user['id']; ?>"><?php echo $user['name']; ?></a> |
            <a href="/mvc-project/public/edit/<?php echo $user['id']; ?>">Edit</a> |
            <form action="/mvc-project/public/delete/<?php echo $user['id']; ?>" method="post" style="display:inline;">
                <button type="submit">Delete</button>
            </form>
        </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>