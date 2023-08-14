<?php

namespace App\DTO;

class PhoneNumberDTO extends DTO
{
    public function __construct(
        public string $country,
        public string $ddd,
        public string $number
    ) {}
}
