<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->params['user']->getName() ?></title>
</head>
<body>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <tr>
            <td><?= $this->params['user']->getId() ?></td>
            <td><?= $this->params['user']->getName() ?></td>
            <td><?= $this->params['user']->getEmail() ?></td>
            <td><?= $this->params['user']->getPassword() ?></td>
        </tr>
    </table>
</body>
</html>