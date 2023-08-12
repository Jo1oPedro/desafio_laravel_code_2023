<?php

namespace App\traits;

trait SpecializedPersonTrait
{
    public function scopeWherePeopleId($query, $specialization)
    {
        return $query->where('people_id', $specialization);
    }
}
