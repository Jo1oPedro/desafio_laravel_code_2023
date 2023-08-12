<?php

namespace App\Http\Resources\People;

use App\Http\Resources\Owner\OwnerResource;
use App\Http\Resources\User\UserResource;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        $common_data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
        ];

        if($user = User::WherePeopleId($this->id)->first()) {
            return array_merge($common_data, [
                'user' => new UserResource($user)
            ]);
        }

        if($owner = Owner::WherePeopleId($this->id)->first()) {
            return array_merge($common_data, [
                'owner' => new OwnerResource($owner)
            ]);
        }
    }
}
