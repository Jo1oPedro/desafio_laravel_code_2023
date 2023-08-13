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
        //$user = User::WherePeopleId($this->id)->first();
        //$owner = Owner::WherePeopleId($this->id)->first();

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            /*'user' => $this->when($this->relationLoaded('users'), function () {
                return $this->users->isNotEmpty() ? new UserResource($this->users->first()) : null;
            }),
            'owner' => $this->whenNotNull($this->owners)*/
        ];

        if($this->relationLoaded('users')) {
            if($this->users?->isNotEmpty()) {
                //$user_resource = new UserResource($this->users->first()?->load('people'));
                $user_resource = new UserResource($this->users->first()->load('admins'));
                $data['user'] = $user_resource;
            }
        }

        if($this->relationLoaded('owners')) {
            if($this->owners?->isNotEmpty()) {
                $owner_resource = new OwnerResource($this->owners->first());
                $data['owner'] = $owner_resource;
            }
        }

        return $data;

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
