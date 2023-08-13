<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Person\PersonResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'user_specialization' => $this->user_specialization
        ];

        if($this->relationLoaded('people')) {
            if($this->people) {
                $person_resource = new PersonResource($this->people->first());
                $data['people'] = $person_resource;
            }
        }

        if($this->relationLoaded('admins')) {
            if($this->admins->isNotEmpty()) {
                $admin_resource = new AdminResource($this->admins->first());
                $data['admin'] =  $admin_resource;
            }
        }

        return $data;
    }
}
