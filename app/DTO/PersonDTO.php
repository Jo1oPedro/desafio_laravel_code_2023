<?php

namespace App\DTO;

class PersonDTO extends DTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $birthdate,
        public string $person_specialization,
        public int $address_id,
        public int $phone_number_id
    ) {}
}
