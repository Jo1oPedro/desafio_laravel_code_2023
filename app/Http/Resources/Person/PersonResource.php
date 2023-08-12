<?php

namespace App\Http\Resources\Person;

use App\Http\Resources\Owner\OwnerResource;
use App\Http\Resources\User\UserResource;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        $user = User::WherePeopleId($this->id)->first();
        $owner = Owner::WherePeopleId($this->id)->first();

        return $common_data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'user' => $this->whenNotNull($user),
            'owner' => $this->whenNotNull($owner)
        ];

        /*if($user = User::WherePeopleId($this->id)->first()) {
            return array_merge($common_data, [
                'user' => new UserResource($user)
            ]);
        }

        if($owner = Owner::WherePeopleId($this->id)->first()) {
            return array_merge($common_data, [
                'owner' => new OwnerResource($owner)
            ]);
        }*/
    }
}
