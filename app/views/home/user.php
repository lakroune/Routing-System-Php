<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->params['user']->name ?></title>
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
            <td><?= $this->params['user']->id ?></td>
            <td><?= $this->params['user']->name ?></td>
            <td><?= $this->params['user']->email ?></td>
            <td><?= $this->params['user']->password ?></td>
        </tr>
    </table>
</body>
</html>