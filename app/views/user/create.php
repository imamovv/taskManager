<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create User</title>
</head>

<body>
    <h1>Create User</h1>
    <form action="/mvc-project/public/create" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>
        <button type="submit">Create</button>
    </form>
    <a href="/mvc-project/public/">Back to Users</a>
</body>

</html>