<?php

namespace App\Http\Controllers\Api;

use App\DTO\AddressDTO;
use App\DTO\EmployeeDTO;
use App\DTO\PhoneNumberDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeStoreFormRequest;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use App\Services\AddressService;
use App\Services\EmployeeService;
use App\Services\PhoneNumberService;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *   title="API Desafio Laravel Code 2023.2",
 *   version="1.5.0",
 *   contact={
 *     "email": "joao.pedreira@estudante.ufjf.br"
 *   }
 * )
 * @OA\SecurityScheme(
 *  type="http",
 *  description="Acess token obtido na autenticação",
 *  name="Authorization",
 *  in="header",
 *  scheme="bearer",
 *  bearerFormat="JWT",
 *  securityScheme="bearerToken"
 * )
 */

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
     * @OA\POST(
     *  tags={"Employee"},
     *  summary="Create a new employee",
     *  description="This endpoint creates a new employee",
     *  path="/api/employees",
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/x-www-form-urlencoded",
     *          @OA\Schema(
     *             required={"name","email","password","password_confirmation","birthdate","neighborhood","street","zip_code","number","country","ddd","phone_number"},
     *             @OA\Property(property="name", type="string", example="Gabriel Nunes"),
     *             @OA\Property(property="email", type="string", example="gabriel_nunes@example.org"),
     *             @OA\Property(property="password", type="string", example="#sdasd$ssdaAA@"),
     *             @OA\Property(property="password_confirmation", type="string", example="#sdasd$ssdaAA@"),
     *             @OA\Property(property="birthdate", type="string", example="1995-08-15"),
     *             @OA\Property(property="neighborhood", type="string", example="Centro"),
     *             @OA\Property(property="street", type="string", example="Rua do passarinho"),
     *             @OA\Property(property="zip_code", type="string", example="37894457"),
     *             @OA\Property(property="number", type="string", example="247"),
     *             @OA\Property(property="country", type="string", example="55"),
     *             @OA\Property(property="ddd", type="string", example="47"),
     *             @OA\Property(property="phone_number", type="string", example="77849874"),
     *          )
     *      ),
     *  ),
     *  @OA\Response(
     *    response=200,
     *    description="Employee created",
     *    @OA\JsonContent(
     *       @OA\Property(property="Employee", type="string", example="['id': 21,'user_id': 32,'work_time': null]")
     *    )
     *  ),
     *  @OA\Response(
     *    response=422,
     *    description="Incorrect fields",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="The email has already been taken"),
     *       @OA\Property(property="errors", type="string", example="..."),
     *    )
     *  )
     * )
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

        return response()->json([
            'employee' => new EmployeeResource(
                $this->employeeService->create($employeDTO)
            ),
        ], 201);
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
