<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\Person\PersonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $data_resource = [];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->data_resource = [
            'id' => $this->id,
            'user_specialization' => $this->user_specialization
        ];

        $this->get_people_loaded_relations();

        $this->get_admins_loaded_relations();

        $this->get_employees_loaded_relations();

        return $this->data_resource;
    }

    private function get_people_loaded_relations()
    {
        if($this->relationLoaded('people')) {
            if($this->people) {
                $person = $this
                    ->people
                    ->where('id', $this->people_id)
                    ->first();
                $person->id = null;
                $person->person_specialization = null;
                $this->data_resource['people'] = new PersonResource($person);
            }
        }
    }

    private function get_admins_loaded_relations()
    {
        if($this->relationLoaded('admins')) {
            if($this->admins->isNotEmpty()) {
                $admin = $this->admins->first();
                $admin->user_id = null;
                $this->data_resource['admin'] =  new AdminResource($admin);
            }
        }
    }

    private function get_employees_loaded_relations()
    {
        if($this->relationLoaded('employees')) {
            if($this->employees->isNotEmpty()) {
                $employee = $this->employees->first();
                $employee->user_id = null;
                $this->data_resource['employee'] =  new EmployeeResource($employee);
            }
        }
    }
}
