# PHP MVC Routing System

A simple PHP MVC routing system built from scratch — handling custom routes, dynamic URL parameters, and view rendering using a lightweight MVC pattern.

Live project repository:  
https://github.com/lakroune/Routing-System-Php

---

##  Features

✅ Custom routing for GET and POST  
✅ Dynamic URL parameters (`/users/{id}`)  
✅ MVC architecture (Models, Views, Controllers)  
✅ Clean URLs via `.htaccess`  
✅ Simple error handling (404 and user‑not‑found)

---

## 📁 Project Structure

```
Routing-System-Php/
│
├─ app/
│  ├─ Controllers/
│  │   └─ HomeController.php
│  ├─ Models/
│  │   └─ User.php
│  └─ Views/
│      └─ home/
│          ├─ index.php
│          ├─ users.php
│          └─ user.php
├─ Core/
│  ├─ Router.php
│  ├─ View.php
│  └─ Exceptions/
│      └─ RouteNotFoundException.php
├─ index.php
├─ .htaccess
└─ README.md
```

---

## 🚀 Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/lakroune/Routing-System-Php.git
   ```
2. Move the project into your local web server folder (e.g., XAMPP `htdocs`):
   ```
   C:\xampp\htdocs\Routing-System-Php
   ```
3. Start Apache (from XAMPP Control Panel).
4. Open your browser:
   ```
   http://localhost/Routing-System-Php/
   ```

---

## 🛠 Configuration

### `.htaccess`  

Make sure mod_rewrite is enabled and place this file in `Routing-System-Php/`:

```apache
RewriteEngine On
RewriteBase /Routing-System-Php/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php [QSA,L]
```

This ensures URLs are clean and routed correctly to `index.php`.

---

## 📍 Routes

| Method | Path             | Description                       |
|--------|-----------------|-----------------------------------|
| GET    | `/`              | Home page                        |
| GET    | `/users`         | List all users                   |
| GET    | `/users/{id}`    | Show user details by ID          |

---

## 📌 Example Usage

### Routes (`index.php`)

```php
$router->get('/', [HomeController::class, 'index']);
$router->get('/users', [HomeController::class, 'getAllUsers']);
$router->get('/users/{id}', [HomeController::class, 'getUser']);
```

---

## ☑ Controllers

**HomeController.php**

```php
<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;

class HomeController
{
    public function index()
    {
        return View::make('home/index', ['name' => 'Ahmed']);
    }

    public function getAllUsers()
    {
        $users = (new User())->getAll();
        return View::make('home/users', ['users' => $users]);
    }

    public function getUser($id)
    {
        $user = (new User())->getOne($id);
        return View::make('home/user', ['user' => $user]);
    }
}
```

---

## 🧠 Views

### `home/index.php`

```php
<h1>Welcome, <?= $name ?></h1>
<a href="/users">View Users</a>
```

### `home/users.php`

```php
<table border="1">
    <tr><th>ID</th><th>Name</th><th>Email</th><th>Password</th></tr>
    <?php foreach($users as $user): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getName() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getPassword() ?></td>
        </tr>
    <?php endforeach; ?>
</table>
```

### `home/user.php`

```php
<?php if ($user): ?>
    <h1>User Details</h1>
    <p>ID: <?= $user->getId() ?></p>
    <p>Name: <?= $user->getName() ?></p>
    <p>Email: <?= $user->getEmail() ?></p>
    <p>Password: <?= $user->getPassword() ?></p>
<?php else: ?>
    <p>User not found!</p>
<?php endif; ?>
```

---

## 📦 Models

**User.php**

- Holds hardcoded list of users
- Can return all users or a single user by ID

```php
public function getOne($id)
{
    return self::data()[$id - 1] ?? null;
}
```

---

## 🔥 Notes

- Make sure `mod_rewrite` is enabled in Apache.
- `/users/{id}` only works for IDs that exist.
- View file paths depend on exact directory structure.
- If view file is missing, an exception will be thrown.

---

## 👨‍💻 Contact

Created by **lakroune**  
GitHub: https://github.com/lakroune  
Email: `lakroune00@gmail.com`
