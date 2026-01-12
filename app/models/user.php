<?php

namespace App\Models;

class User
{
    public function __construct(
        public $id = null,
        public $name = null,
        public $email = null,
        public $password = null
    ) {}

    private static function data()
    {
        return [
            new User(1, 'Ahmed', 'ahmed@gmail.com', 'test123'),
            new User(2, 'Sara', 'sara@gmail.com', 'test123'),
            new User(3, 'Ali', 'ali@gmail.com', 'test123'),
            new User(4, 'Omar', 'omar@gmail.com', 'test123'),
            new User(5, 'Khalid', 'khalid@gmail.com', 'test123')
        ];
    }

    public function getAll()
    {
        return self::data();
    }

    public function getOne($id)
    {
        return array_filter(self::data(), fn($item) => $item->id == $id)[0] ?? null;
    }

    public function create(array $data)
    {
        $newId = count(self::data()) + 1;
        return new User($newId, $data['name'] ?? null, $data['email'] ?? null, $data['password'] ?? null);
    }
}
