<?php

namespace App\Models;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    /**
     * Construct a new User instance.
     *
     * @param int $id The ID of the user
     * @param string $name The name of the user
     * @param string $email The email of the user
     * @param string $password The password of the user
     */
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Gets the ID of the user.
     *
     * @return int The ID of the user
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Returns the name of the user.
     *
     * @return string The name of the user
     */
    public  function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the email of the user.
     *
     * @return string The email of the user
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Returns the password of the user.
     *
     * @return string The password of the user
     */
    public function getPassword(): string
    {
        return $this->password;
    }


    /**
     * Sets the ID of the user.
     *
     * @param int $id The ID of the user
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * Sets the name of the user.
     *
     * @param string $name The name of the user
     *
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Sets the email of the user.
     *
     * @param string $email The email of the user
     *
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Sets the password of the user.
     *
     * @param string $password The password of the user
     *
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Returns an array of all users.
     *
     * The array contains five users with IDs from 1 to 5.
     *
     * @return array An array of all users
     */
    private static function data()
    {
        return [
            new User(1, 'Ismail', 'ismail@gmail.com', 'test123'),
            new User(2, 'Khalid', 'Khalid@gmail.com', 'test123'),
            new User(3, 'Ali', 'ali@gmail.com', 'test123'),
            new User(4, 'Omar', 'omar@gmail.com', 'test123'),
            new User(5, 'Anass', 'anass@gmail.com', 'test123')
        ];
    }

    /**
     * Returns an array of all users.
     *
     * This method returns an array containing all users.
     *
     * @return array An array of all users
     */
    public function getAll()
    {
        return self::data();
    }

    /**
     * Returns a user by its ID.
     *
     * @param int $id The ID of the user
     *
     * @return User The user with the given ID
     */
    public function getOne($id)
    {
        return self::data()[$id - 1];
    }
}
