<?php

namespace App\Http\Resources\Person;

use App\Http\Resources\Owner\OwnerResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    private array $data_resource = [];
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->data_resource = [
            'id' => $this->whenNotNull($this->id),
            'name' => $this->name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'person_specialization' => $this->whenNotNull($this->person_specialization)
        ];

        $this->get_users_loaded_relations();

        $this->get_owners_loaded_relations();

        return $this->data_resource;
    }

    private function get_users_loaded_relations()
    {
        if($this->relationLoaded('users')) {
            if($this->users?->isNotEmpty()) {
                $this->data_resource['user'] = new UserResource(
                    $this->users->first()->load($this->get_users_loaded_specif_relations())
                );
            }
        }
    }

    private function get_users_loaded_specif_relations()
    {
        $specif_relations = [];

        if($this->relationLoaded('employee')) {
            $specif_relations[] = 'employee';
        }

        if($this->relationLoaded('admins')) {
            $specif_relations[] = 'admins';
        }

        return $specif_relations;
    }

    private function get_owners_loaded_relations()
    {
        if($this->relationLoaded('owners')) {
            if($this->owners?->isNotEmpty()) {
                $this->data_resource['owner'] = new OwnerResource($this->owners->first());
            }
        }
    }
}
