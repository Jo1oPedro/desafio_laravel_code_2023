<?php

namespace App\Services;

use App\DTO\DTO;
use App\DTO\EmployeeDTO;
use App\DTO\UserDTO;
use App\Models\Employee;

class EmployeeService implements iService
{
    public function __construct(
        private UserService $userService
    ) {}

    public function create(DTO $employeeDTO)
    {
        $userDTO = new UserDTO(
            $employeeDTO->name,
            $employeeDTO->email,
            $employeeDTO->password,
            $employeeDTO->birthdate,
            'employees',
            $employeeDTO->address_id,
            $employeeDTO->phone_number_id
        );

        $employeeDTO->user_id = $this->userService->create($userDTO)->id;

        return Employee::create($employeeDTO->toArray());
    }
}
