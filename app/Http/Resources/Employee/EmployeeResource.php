<?php

namespace App\Http\Resources\Employee;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\User\UserResource;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'user_id' => $this->whenNotNull($this->user_id),
            'work_time' => $this->work_time
        ];

        $this->get_user_loaded_relations();

        return $this->data_resource;
    }

    private function get_user_loaded_relations()
    {
        if($this->relationLoaded('user')) {
            if($this->user) {
                $user = User::where('id', $this->user_id)
                    ->first();

                $this->data_resource['user'] =  new UserResource(
                    $user->load($this->get_user_loaded_specif_relation())
                );
            }
        }
    }

    private function get_user_loaded_specif_relation()
    {
        $specif_relations = [];

        if($this->user->relationLoaded('people')) {
            $specif_relations[] = 'people';
        }

        return $specif_relations;
    }
}
