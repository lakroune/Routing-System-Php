<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>

<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php foreach ($this->params['users'] as $value): ?>
            <tr>
                <td><?= $value->getId() ?></td>
                <td><?= $value->getName() ?></td>
                <td><?= $value->getEmail() ?></td>
                <td><?= $value->getPassword() ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>