<?php

namespace App\DTO;

readonly class BasicData
{
    public function toArray()
    {
        return json_decode(json_encode($this), true);
    }
}
