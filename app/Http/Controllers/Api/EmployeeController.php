<?php

namespace App\Http\Controllers\Api;

use App\DTO\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreFormRequest;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Address;
use App\Models\Employee;
use App\Models\PhoneNumber;
use App\Services\EmployeeService;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        private EmployeeService $employeeService
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
        $address = Address::find(1)->first();
        $phone_number = PhoneNumber::find(1)->first();

        $employeDTO = new EmployeeDTO(
            $request->name,
            $request->email,
            $request->password,
            $request->birthdate,
            $address->id,
            $phone_number->id
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
