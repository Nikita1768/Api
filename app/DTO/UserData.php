<?php

namespace App\DTO;

readonly class UserData extends BasicData
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {
    }
}
