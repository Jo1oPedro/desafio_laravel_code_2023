<?php

namespace App\Models;

use App\traits\SpecializedPeopleTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory,
    SpecializedPeopleTrait;
    protected $fillable = [
        'person_id',
        'profile_picture'
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class)
            ->withPivot('finished');
    }
}
