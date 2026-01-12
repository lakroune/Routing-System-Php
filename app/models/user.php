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
            new User(1, 'Ismail', 'ismail@gmail.com', 'test123'),
            new User(2, 'Khalid', 'Khalid@gmail.com', 'test123'),
            new User(3, 'Ali', 'ali@gmail.com', 'test123'),
            new User(4, 'Omar', 'omar@gmail.com', 'test123'),
            new User(5, 'Anass', 'anass@gmail.com', 'test123')
        ];
    }

    public function getAll()
    {
        return self::data();
    }

    public function getOne($id)
    {
        return self::data()[$id - 1];
    }
}
