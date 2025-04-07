<?php

namespace App\DTO;

readonly class PlanData extends BasicData
{
    public function __construct(
        public string $name,
        public float $price,
        public int $publications,
        public int $status,
        public string|null $id = null
    )
    {
    }
}
