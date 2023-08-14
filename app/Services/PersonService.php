<?php

namespace App\Services;

use App\DTO\DTO;
use App\DTO\PersonDTO;
use App\Models\Person;

class PersonService implements iService
{
    public function create(DTO $personDTO)
    {
        return Person::create($personDTO->toArray());
    }
}
