<?php

namespace App\Http\Controllers\Api;

use App\DTO\AddressDTO;
use App\DTO\EmployeeDTO;
use App\DTO\PhoneNumberDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreFormRequest;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Address;
use App\Models\Employee;
use App\Models\PhoneNumber;
use App\Services\AddressService;
use App\Services\EmployeeService;
use App\Services\PhoneNumberService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeService $employeeService,
        private AddressService $addressService,
        private PhoneNumberService $phoneNumberService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new EmployeeCollection(
            Employee::with('user.people')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeStoreFormRequest $request)
    {
        $address_id = $this->addressService->create(
            new AddressDTO(
                $request->neighborhood,
                $request->street,
                $request->zip_code,
                $request->number
            )
        )->id;

        $phone_number_id = $this->phoneNumberService->create(
            new PhoneNumberDTO(
                $request->country,
                $request->ddd,
                $request->phone_number
            )
        )->id;

        $employeDTO = new EmployeeDTO(
            $request->name,
            $request->email,
            $request->password,
            $request->birthdate,
            $address_id,
            $phone_number_id
        );

        return ['employee' => new EmployeeResource(
            $this->employeeService->create($employeDTO)
        )];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
