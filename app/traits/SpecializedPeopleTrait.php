<?php

namespace App\traits;

trait SpecializedPeopleTrait
{
    public function scopeWherePeopleId($query, $specialization)
    {
        return $query->where('people_id', $specialization);
    }
}
