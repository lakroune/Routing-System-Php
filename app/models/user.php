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
            new user(1, 'Ismaillakroune', 'lakroune00@gmail', '123456'),
            new user(2, 'anasElghazi', 'anas@gmail', '123456'),
            new user(3, 'mouadGourita', 'mouad@gmail', '123456'),
            new user(4, 'mohamedHassan', 'mohamed@gmail', '123456'),
            new user(5, 'Ahmed', 'ahmed@gmail', '123456')
        ];
    }

    /**
     * Returns an array of user instances.
     *
     * This method returns an array of user instances containing all the predefined users.
     *
     * @return array<User> An array of user instances.
     */
    public function getAll()
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
    public function getOne($id)
    {
        return array_filter(self::data(), function ($item) use ($id) {
            return $item->id == $id;
        })[0] ?? null;
    }
}
