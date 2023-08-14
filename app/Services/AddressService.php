<?php

namespace App\Services;

use App\DTO\AddressDTO;
use App\DTO\DTO;
use App\Models\Address;

class AddressService implements iService
{
    public function create(DTO $addressDTO)
    {
        return Address::create($addressDTO->toArray());
    }
}
