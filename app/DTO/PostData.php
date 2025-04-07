<?php

namespace App\DTO;

readonly class PostData extends BasicData
{
    public function __construct(
        public string $title,
        public string $description,
        public string $user_id,
        public string|null $id = null
    )
    {
    }


}
