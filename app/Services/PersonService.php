<?php

namespace App\Services;

use App\DTO\PersonDTO;
use App\Models\Person;

class PersonService
{
    public function create(PersonDTO $personDTO)
    {
        return Person::create($personDTO->toArray());
    }
}
