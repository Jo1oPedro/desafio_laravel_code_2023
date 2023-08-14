<?php

namespace App\DTO;

abstract class DTO
{
    public function toArray()
    {
        return get_object_vars($this);
    }
}
