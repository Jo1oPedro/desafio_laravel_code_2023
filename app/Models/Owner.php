<?php

namespace App\Models;

use App\traits\SpecializedPersonTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory,
    SpecializedPersonTrait;
    protected $fillable = [
        'person_id',
        'profile_picture'
    ];

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    public function pets()
    {
        return $this->belongsToMany(Pet::class)
            ->withPivot('finished');
    }
}
