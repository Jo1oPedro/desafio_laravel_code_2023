<?php

namespace App\Http\Resources\Person;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    /**
     * The "data" wrapper that should be applied.
     *
     * @var string|null
     */
    //public static $wrap = 'user';
    public function toArray(Request $request): array
    {
        return [
            'persons' => $this->collection
        ];
    }
}
