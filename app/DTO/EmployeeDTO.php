<?php

namespace App\DTO;

use App\Models\Address;
use App\Models\PhoneNumber;

class EmployeeDTO extends DTO
{
    public string $neighborhood;
    public string $street;
    public string $zip_code;
    public string $number;
    public string $country;
    public string $ddd;
    public string $phone_number;
    public string $work_time;

    public int $user_id;
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $birthdate,
        public int $address_id,
        public int $phone_number_id,
    ) {}
}
