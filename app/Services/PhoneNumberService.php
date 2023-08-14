<?php

namespace App\Services;

use App\DTO\DTO;
use App\DTO\PhoneNumberDTO;
use App\Models\PhoneNumber;

class PhoneNumberService implements iService
{
    public function create(DTO $phoneNumberDTO)
    {
        return PhoneNumber::create($phoneNumberDTO->toArray());
    }
}
