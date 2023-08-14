<?php

namespace App\DTO;

class AddressDTO extends DTO
{
    public function __construct(
        public string $neighborhood,
        public string $street,
        public string $zip_code,
        public string $number
    ) {}
}
