<?php

namespace App\DTO;

readonly class LoginData extends BasicData
{
    public function __construct(
        public string $email,
        public string $password
    )
    {
    }
}
