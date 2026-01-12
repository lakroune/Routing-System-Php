<?php

namespace App\Models;

class User
{
    private $list = [];

    /**
     * Constructor for User class.
     *
     * @param int|null $id User ID.
     * @param string|null $name User name.
     * @param string|null $email User email.
     * @param string|null $password User password.
     */
    public function __construct(
        public $id = null,
        public $name = null,
        public $email = null,
        public $password = null
    ) {}

    /**
     * Return an array of user instances.
     *
     * This method returns an array of user instances that can be used for testing.
     * It contains a set of predefined users with their respective IDs, names, emails, and passwords.
     *
     * @return array<User> An array of user instances.
     */
    private static function data()
    {
        return [
            new User(1, 'Ahmed', 'ahmed@gmail.com', 'test123'),
            new User(2, 'Sara', 'sara@gmail.com', 'test123'),
            new User(3, 'Ali', 'ali@gmail.com', 'test123'),
            new User(4, 'Omar', 'omar@gmail.com', 'test123'),
            new User(5, 'Khalid', 'khalid@gmail.com', 'test123'),
            new User(6, 'Hassan', 'hassan@gmail.com', 'test123'),
            new User(7, 'Nour', 'nour@gmail.com', 'test123'),
            new User(8, 'Fatima', 'fatima@gmail.com', 'test123'),
            new User(9, 'Mona', 'mona@gmail.com', 'test123'),
            new User(10, 'Nadia', 'nadia@gmail.com', 'test123'),
            new User(11, 'Omar', 'omar@gmail.com', 'test123'),
            new User(12, 'Khalid', 'khalid@gmail.com', 'test123'),
            new User(13, 'Hassan', 'hassan@gmail.com', 'test123'),
            new User(14, 'Nour', 'nour@gmail.com', 'test123'),
            new User(15, 'Fatima', 'fatima@gmail.com', 'test123'),
            new User(16, 'Mona', 'mona@gmail.com', 'test123'),
            new User(17, 'Nadia', 'nadia@gmail.com', 'test123'),
            new User(18, 'Omar', 'omar@gmail.com', 'test123'),
            new User(19, 'Khalid', 'khalid@gmail.com', 'test123'),
            new User(20, 'Hassan', 'hassan@gmail.com', 'test123'),
        ];
    }

    /**
     * Returns an array of user instances.
     *
     * This method returns an array of user instances containing all the predefined users.
     *
     * @return array<User> An array of user instances.
     */
    public function getAll(): array
    {
        return self::data();
    }

    /**
     * Returns a single user instance by ID.
     *
     * This method returns a single user instance with the given ID, or null if no user is found.
     *
     * @param int $id The ID of the user to retrieve.
     * @return User|null The user instance with the given ID, or null if no user is found.
     */
    public function getOne($id): ?User
    {
        return array_filter(self::data(), function ($item) use ($id) {
            return $item->id == $id;
        })[0] ?? null;
    }
}
