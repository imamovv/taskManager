<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>
    <form action="/mvc-project/public/edit/<?php echo $user['id']; ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <button type="submit">Update</button>
    </form>
    <a href="/mvc-project/public/">Back to Users</a>
</body>

</html>